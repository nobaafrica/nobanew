<?php

namespace App\Listeners;

use App\Events\CustomerIdentified;
use App\Models\Wallet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendCustomerIdentificationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CustomerIdentified  $event
     * @return void
     */
    public function handle(CustomerIdentified $event)
    {
        $url = 'https://api.paystack.co/dedicated_account';
        $request = Http::withToken(config('app.paystack_secret'))->post($url, [
            'customer' => $event->customer
        ])->object();
        if($request->status == true):
            $data = $request->data;
            Wallet::where('customerCode', $event->customer)->update([
                'bank' => $data->bank->name,
                'accountNumber' => $data->account_number,
                'accountName' => $data->account_name,
            ]);
        endif;
    }
}
