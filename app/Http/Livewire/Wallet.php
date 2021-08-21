<?php

namespace App\Http\Livewire;

use App\Events\CustomerIdentified;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Wallet as ModelsWallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class Wallet extends Component
{
    public $wallet;
    public $user;
    public $nuban;
    public $bank;
    public $accountName;
    public $withdrawableBalance;
    public $referralBonus;
    public $fundingAmount;
    public $transactions;
    protected $creditTx;
    protected $debitTx;
    

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $this->wallet = $this->user->wallet;
        $this->nuban = is_null($this->wallet) ? null : $this->wallet->accountNumber;
        $this->bank = is_null($this->wallet) ? null : $this->wallet->bank;
        $this->accountName = is_null($this->wallet) ? null : $this->wallet->accountName;
        $this->withdrawableBalance = is_null($this->wallet) ? null : $this->wallet->withdrawableBalance;
        $this->referralBonus = is_null($this->wallet) ? null : $this->wallet->referralBonus;
        $this->transactions = $this->user->transactions;
        $this->creditTx = $this->transactions->where('transactionType', 'credit');
        $this->debitTx = $this->transactions->where('transactionType', 'debit');
    }

    public function generateWallet()
    {
        if(empty($this->wallet)):
            $url = "https://api.paystack.co/customer";
            $request = Http::withToken(config('app.paystack_secret'))->post($url, [
                'first_name' => $this->user->firstName,
                'last_name' => $this->user->lastName,
                'phone' => $this->user->phoneNumber,
                'email' => $this->user->email,
            ])->object();
            if($request->status == true):
                $customer = $request->data->customer_code;
                $this->user->wallet()->create([
                        'id' => Str::uuid(),
                        'customerCode' => $customer
                ]);
            else:
                session()->flash('error', $request->message);
            endif;
        endif;
        $wallet = ModelsWallet::where('user_id', $this->user->id)->first();
        $customer = $wallet->customerCode;
        
        $validationUrl = "https://api.paystack.co/customer/$customer/identification";
        $verify = Http::withToken(config('app.paystack_secret'))->post($validationUrl, [
            "country" => "NG",
            "type" => "bvn",
            "value" => $this->user->bank->first()->bvn,
            "first_name" => $this->user->firstName,
            "last_name" => $this->user->lastName,
        ])->object();

        if($verify->status == true):
            session()->flash('success', $verify->message);
        elseif($verify->message == "Customer already identified"):
            CustomerIdentified::dispatch($customer);
            return redirect()->route('wallet');
        endif;
    }

    public function fundWallet()
    {
        $url = "https://api.paystack.co/transaction/initialize";
        $ref = mt_rand();
        $initpayment = Http::withToken(config('app.paystack_secret'))->post($url, [
            'reference' => $ref,
            'email' => $this->user->email,
            'amount' => $this->fundingAmount * 100,
            'callback_url' => config('app.payment_callback'),
        ])->object();

        if($initpayment->status == 'true'):
            $this->user->transactions()->create([
                'id' => Str::uuid(), 
                'transactionType' => 'credit', 
                'amount' => $this->fundingAmount, 
                'reference' => $ref, 
                'status' => 'pending', 
                'time' => now(),
            ]);
            return redirect($initpayment->data->authorization_url);
        else:
            session()->flash('error', 'Unable to initialize payment');
        endif;
    }

    public function txs()
    {
        $query = DB::table('transactions')->select(DB::raw('DATE_FORMAT(time, "%b") AS x'), DB::raw('SUM(amount) as y'),)->where(['user_id' => $this->user->id])->groupByRaw(DB::raw('MONTH(time)'))->orderBy(DB::raw('MONTH(time)'))->get();
        return $query->toJson();
    }

    public function render()
    {
       
        return view('livewire.wallet')->with(['txs' => $this->txs()]);
    }
}
