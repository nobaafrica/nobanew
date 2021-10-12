<?php

namespace App\Traits;

use App\Events\CustomerIdentified;
use App\Models\Wallet;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait PaystackCustomerTrait
{
    public function createCustomerProfile(object $user)
    {
        $url = "https://api.paystack.co/customer";
        $request = Http::withToken(config('app.paystack_secret'))->post($url, [
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
            'phone' => $user->phoneNumber,
            'email' => $user->email,
        ])->object();
        if($request->status == 'true'):
            $customer = $request->data->customer_code;
            $wallet = Wallet::where('user_id', $user->id)->first();
            if($wallet):
                $user->wallet()->update([
                    'customerCode' => $customer,
                ]);
            else:
                $user->wallet()->create([
                    'id' => Str::uuid(),
                    'customerCode' => $customer
                ]);
            endif;
            return $this->verifyCustomer($customer, $user);
        else:
            session()->flash('error', $request->message);
        endif;
    }

    public function verifyCustomer(string $customer, object $user)
    {
        $validationUrl = "https://api.paystack.co/customer/$customer/identification";
        $verify = Http::withToken(config('app.paystack_secret'))->post($validationUrl, [
            "country" => "NG",
            "type" => "bank_account",
            "account_number" => $user->bank()->first()->nuban,
            "bvn" => $user->bank()->first()->bvn,
            "bank_code" =>  $user->bank()->first()->bank_code,
            "first_name" => $user->firstName,
            "last_name" => $user->lastName,
        ])->object();
        if($verify->status == 'true'):
            session()->flash('success', $verify->message);
            CustomerIdentified::dispatch($customer);
        else:
            session()->flash('error', $verify->message);
        endif;
        return redirect()->route('wallet');
    }
}