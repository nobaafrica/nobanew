<?php

namespace App\Console\Commands;

use App\Mail\PayoutIsReady;
use App\Models\Package;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RedeemCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redeem:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email and update payment period';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $activePartnerships = DB::table('users')
            ->join('partnerships', 'users.id', '=', 'partnerships.user_id')
            ->join('packages', 'partnerships.package_id', '=', 'packages.id')
            ->where([['isRedeemed','=', 0], ['period', '>', 1], ['payoutDate', '>', now()]])
            ->select(['partnerships.id as partnership_id', 'users.id', 'period', 'no_of_matured_payout', 'partnerships.created_at'])
            ->get();

        foreach ($activePartnerships as $activePartnership) {
            $packagePeriod = $activePartnership->period;
            $maturedPayout = $activePartnership->no_of_matured_payout;
            $createdDate = $activePartnership->created_at;
            $futureDate = date('Y-m-d', strtotime($createdDate . ' +  ' . $packagePeriod * ($maturedPayout ?: 1) . 'months'));
            $today = date('Y-m-d', strtotime(now()));
            $partnership = Partnership::find($activePartnership->partnership_id);
            $package = $partnership->package;
            $totalPayout = Package::totalPayouts($package);

            if ($today == $futureDate && $maturedPayout != $totalPayout) {
                $partnership->no_of_matured_payout += 1;
                $partnership->save();

                $profit = \App\Models\Package::periodicPayout($package);

                $user = User::find($activePartnership->id);
                $user->wallet()->update([
                    'withdrawableBalance' => $user->wallet->withdrawableBalance + $profit
                ]);

                $user->transactions()->create([
                    'id' => Str::uuid(),
                    'user_id' => $activePartnership->id,
                    'transactionType' => 'credit',
                    'amount' => $profit,
                    'reference' => $activePartnership->partnership_id,
                    'status' => 'success',
                    'time' => now(),
                    'payment_method' => 'Automated'
                ]);
                Mail::to($user)->queue(new PayoutIsReady($user));
            }
        }
        return;
    }
}
