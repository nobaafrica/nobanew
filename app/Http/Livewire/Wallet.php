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
use Illuminate\Support\Facades\Cache;
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
    public $banks;
    public $withdrawalAmount;
    public $userBank;
    public $userAccount;
    

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
        $this->userBank = is_null($this->user->bank()->first()) ? null : $this->user->bank()->first()->bank;
        $this->userAccount = is_null($this->user->bank()->first()) ? null : $this->user->bank()->first()->nuban;
    }

    public function generateWallet()
    {
        if(is_null($this->wallet)):
            $url = "https://api.paystack.co/customer";
            $request = Http::withToken(config('app.paystack_secret'))->post($url, [
                'first_name' => $this->user->firstName,
                'last_name' => $this->user->lastName,
                'phone' => $this->user->phoneNumber,
                'email' => $this->user->email,
            ])->object();
            if($request->status == true):
                $customer = $request->data->customer_code;
                if(is_null($this->wallet)):
                    $this->user->wallet()->create([
                            'id' => Str::uuid(),
                            'customerCode' => $customer
                    ]);
                endif;
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
            "value" => $this->user->bank()->first()->bvn,
            "first_name" => $this->user->firstName,
            "last_name" => $this->user->lastName,
        ])->object();

        if($verify->status == true):
            CustomerIdentified::dispatch($customer);
            session()->flash('success', $verify->message);
            return redirect()->route('wallet');
        elseif($verify->message == "Customer already identified"):
            session()->flash('success', $verify->message);
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

    public function withdrawFunds()
    {
        // check available funds
        if(is_null($this->wallet)):
            session()->flash('error', 'please setup and fund your wallet');
        else:
            if($this->withdrawalAmount > $this->withdrawableBalance):
                session()->flash('error', 'You do not have enough money in your for this transaction');
            else:
                // get user bank info
                $account = is_null($this->user->bank()->first()->nuban) ? null : $this->user->bank()->first()->nuban;
                $userBank = is_null($this->user->bank()->first()->nuban) ? null : $this->user->bank()->first()->bank;
                // get transfer info
                if($this->user->withdrawal()->count() < 1):
                    $withdrawalInfo = $this->firstWithdrawal($account, $userBank);
                else:
                    $withdrawalInfo = $this->user->withdrawal->last();
                endif;
                $initTransfer = Http::withToken(config('app.paystack_secret'))->post('https://api.paystack.co/transfer', [
                    'source' => 'balance',
                    'amount' => $this->withdrawalAmount * 100,
                    'recipient' => $withdrawalInfo->recipient_code,
                    'reason' => 'Noba Africa Partnership Payout'
                ])->object();
                // initialize transfer
                if($initTransfer->status == true):
                    $this->user->transactions()->create([
                        'id' => Str::uuid(), 
                        'transactionType' => 'debit', 
                        'amount' => $this->withdrawalAmount, 
                        'reference' => $initTransfer->data->reference, 
                        'status' => 'pending', 
                        'time' => now(),
                    ]);
                    session()->flash('success', 'Withdrawal initiated successfully');
                    return redirect()->route('wallet');
                endif;
            endif;
        endif;
    }

    protected function firstWithdrawal($account, $userBank)
    {
        // fetch banks list from paystack
        $getBanks = Cache::remember('paystack-banks', now()->addDays(30), function () {
            $request = Http::withToken(config('app.paystack_secret'))->get('https://api.paystack.co/bank')->object();
            return collect($request->data);
        });
        // get bank code from paystack bank list
        $getBankCode = $getBanks->where('name', $userBank)->first();
        $bankcode = $getBankCode->code;
        // verify user account number
        $verifyAccount = Http::withToken(config('app.paystack_secret'))->get('https://api.paystack.co/bank/resolve', [
            'account_number' => $account,
            'bank_code' => $bankcode,
        ])->object();
        // create transfer recipient
        if($verifyAccount->status == 'true'):
            $createRecipient = Http::withToken(config('app.paystack_secret'))->post('https://api.paystack.co/transferrecipient', [
                "type" => "nuban", 
                "name" => $verifyAccount->data->account_name, 
                "account_number" => $verifyAccount->data->account_number, 
                "bank_code" => $bankcode, 
                "currency" => "NGN"
            ])->object();
            if($createRecipient->status == true):
                $this->user->withdrawal()->create([
                    'recipient_code' => $createRecipient->data->recipient_code, 
                    'bank_code' => $createRecipient->data->details->bank_code, 
                    'bank_name' => $createRecipient->data->details->bank_name,
                ]);
                return $this->user->withdrawal->last();
            endif;
        endif;
    }

    public function render()
    {
       
        return view('livewire.wallet')->with(['txs' => $this->txs()]);
    }
}
