<?php

namespace App\Jobs;

use App\Events\CustomerIdentified;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Bank;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        $customer = empty($data['customer_code']) ? $data['customer']['customer_code'] : $data['customer_code'];
        $wallet = Wallet::where('customerCode', $customer)->first();
        Log::info($data);
        match ($event) {
            'customeridentification.success' => $wallet->update(['verified' => 1]),
            'customeridentification.failed' =>  Log::info("Customer identification failed"),
            'charge.success' => Transactions::create([
                'id' => Str::uuid(),
                'user_id' => $wallet->user_id,
                'transactionType' => 'credit',
                'amount' => $data['amount']/100,
                'reference' => $data['reference'],
                'status' => $data['status'],
                'time' => $data['paid_at'],
                'payment_method' => $data['channel'],
            ]),
        };
        if($event == 'charge.success'):
            $wallet->accountBalance = $wallet->accountBalance + $data['amount']/100;
            $wallet->save();
        elseif($event == 'transfer.success'):
            $tx = Transactions::where('reference', $data['reference'])->first();
            if($tx->status == 'pending'):
                $tx->update(['status' => $data['status'], 'payment_method' => 'transfer']);
                $user = Bank::where('nuban', $data['recipient']['details']['account_number'])->first();
                $wallet = Wallet::where('user_id', $user->user->id)->first();
                $wallet->accountBalance = ($wallet->withdrawableBalance - $wallet->referralBonus) - $data['amount']/100;
                $wallet->save();
            endif;
        elseif($event == 'transfer.failed'):
            Transactions::where('reference', $data['reference'])->update(['status' => $data['status']]);
        endif;
    }
}
