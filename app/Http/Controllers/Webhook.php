<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWebhook;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Webhook extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateRequest(Request $request)
    {
        if($request->isMethod('POST') && $request->hasHeader('x-paystack-signature')):
            $signingSecret = hash_hmac('sha512', $request->getContent(), config('app.paystack_secret'));
            $signature = $request->header('x-paystack-signature');
            if(hash_equals($signature, $signingSecret)):
                Log::debug($request->all());
                ProcessWebhook::dispatch($request->all());
                return response('success', 200);
            endif;
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyPayment()
    {
        $tref = request()->query('trxref');
        $url = "https://api.paystack.co/transaction/verify/$tref";
        $request = Http::withToken(config('app.paystack_secret'))->get($url)->object();
        if($request->data->status == 'success'):
            $user = User::find(Auth::user()->id);
            $user->wallet()->update([
                'withdrawableBalance' =>  $user->wallet->withdrawableBalance + $request->data->amount/100,
                'accountBalance' =>  $user->wallet->accountBalance + $request->data->amount/100,
            ]);
            Transactions::where('reference', $tref)->update([
                'status' => 'success',
                'time' => now(),
                'payment_method' => $request->data->channel
            ]);
            session()->flash('success', 'Wallet funded successfully');
            return redirect()->route('wallet');
        endif;
    }
}
