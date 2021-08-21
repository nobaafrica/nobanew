<?php

namespace App\Jobs;

use App\Events\CustomerIdentified;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = $this->event['event'];
        $data = $this->event['data'];
        $wallet = Wallet::where('customerCode', $data['customer_code'])->first();
        if($event == 'customeridentification.success'):
            $wallet->verified = 1;
            $wallet->save();
            CustomerIdentified::dispatch($data['customer_code']);
        elseif($event == 'charge.success'):
            $user = User::find($wallet->user_id);
            $user->transactions()->create([
                'id' => Str::uuid(), 
                'transactionType' => 'credit', 
                'amount' => $data['amount']/100, 
                'reference' => $data['reference'], 
                'status' => $data['status'], 
                'time' => $data['paid_at'],
                'payment_method' => $data['channel'],
            ]);
            $wallet->accountBalance = $wallet->accountBalance + $data['amount'];
            $wallet->withdrawableBalance = $wallet->withdrawableBalance + $data['amount'];
            $wallet->save();
        endif;
    }
}
