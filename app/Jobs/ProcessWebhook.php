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
        if($event == 'customeridentification.success'):
            $customer = $data['customer_code'];
            $wallet = Wallet::where('customerCode', $customer)->update([
                'verified' => 1
            ]);
            CustomerIdentified::dispatch($customer);
        elseif($event == 'customeridentification.failed'):
            Log::info("Customer identification failed");
        elseif($event == 'charge.success'):
            $customer = empty($data['customer_code']) ? $data['customer']['customer_code'] : $data['customer_code'];
            $wallet = Wallet::where('customerCode', $customer)->first();
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
            $wallet->accountBalance = $wallet->accountBalance + $data['amount']/100;
            $wallet->withdrawableBalance = $wallet->withdrawableBalance + $data['amount']/100;
            $wallet->save();
        elseif($event == 'transfer.success'): 
            Transactions::where('reference', $data['reference'])->update(['status' => $data['status'], 'payment_method' => 'transfer']);
            $user = Bank::where('nuban', $data['recipient']['details']['account_number'])->first();
            $wallet = Wallet::where('user_id', $user->user->id)->first();
            $wallet->accountBalance = $wallet->accountBalance - $data['amount']/100;
            $wallet->withdrawableBalance = $wallet->withdrawableBalance - $data['amount']/100;
            $wallet->save();
        elseif($event == 'transfer.failed'): 
            Transactions::where('reference', $data['reference'])->update(['status' => $data['status']]);
        endif;
    }
}
