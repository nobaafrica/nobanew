<?php

namespace App\Http\Livewire;

use App\Events\CustomerIdentified;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Wallet as ModelsWallet;
use App\Models\Withdrawal;
use App\Traits\PaystackCustomerTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Wallet extends Component
{
    use PaystackCustomerTrait;

    public $wallet;
    public $user;
    public $nuban;
    public $bank;
    public $accountName;
    public $withdrawableBalance;
    public $walletBalance;
    public $referralBonus;
    public $fundingAmount;
    public $transactions;
    public $creditTx;
    protected $debitTx;
    public $banks;
    public $withdrawalAmount;
    public $userBank;
    public $userAccount;
    public $totalWithdrawn;


    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $this->wallet = $this->user->wallet;
        $this->nuban = is_null($this->wallet) ? null : $this->wallet->accountNumber;
        $this->bank = is_null($this->wallet) ? null : $this->wallet->bank;
        $this->accountName = is_null($this->wallet) ? null : $this->wallet->accountName;
        $this->withdrawableBalance = is_null($this->wallet) ? null : $this->wallet->accountBalance - $this->wallet->referralBonus;
        $this->walletBalance = is_null($this->wallet) ? null : $this->wallet->accountBalance;
        $this->referralBonus = is_null($this->wallet) ? null : $this->wallet->referralBonus;
        $this->transactions = $this->user->transactions;
        $this->creditTx = $this->transactions->where('transactionType', 'credit');
        $this->debitTx = $this->transactions->where('transactionType', 'debit');
        $this->userBank = is_null($this->user->bank()->first()) ? null : $this->user->bank()->first()->bank;
        $this->userAccount = is_null($this->user->bank()->first()) ? null : $this->user->bank()->first()->nuban;
        $this->totalWithdrawn = is_null($this->user->withdrawal) ? null : $this->user->withdrawal()->where('status', '!=', 'pending')->sum('amount');
    }

    public function generateWallet()
    {
        $wallet = ModelsWallet::where('user_id', $this->user->id)->first();
        $customerRequest = Http::withToken(config('app.paystack_secret'))->get("https://api.paystack.co/customer/".Auth::user()->email);
        $fetchCustomer = $customerRequest->object();
        if($fetchCustomer->status == 'true'):
            if($fetchCustomer->data->identified== 'true' && !empty($fetchCustomer->data->dedicated_account)):
                $wallet ? $wallet->update([
                    'bank' => $fetchCustomer->data->dedicated_account->bank->name,
                    'customerCode' => $fetchCustomer->data->customer_code,
                    'accountNumber' => $fetchCustomer->data->dedicated_account->account_number,
                    'accountName' => $fetchCustomer->data->dedicated_account->account_name,
                ]) : $this->user->wallet()->updateOrCreate(
                    ['user_id' => $this->user->id],
                    [
                        'id' => Str::uuid(),
                        'bank' => $fetchCustomer->data->dedicated_account->bank->name,
                        'customerCode' => $fetchCustomer->data->customer_code,
                        'accountNumber' => $fetchCustomer->data->dedicated_account->account_number,
                        'accountName' => $fetchCustomer->data->dedicated_account->account_name,
                ]);
                session()->flash('success', "Account generated successfully");
                return redirect()->route('wallet');
            elseif($fetchCustomer->data->identified == 'true' && empty($fetchCustomer->data->dedicated_account)):
                CustomerIdentified::dispatch($fetchCustomer->data->customer_code);
                session()->flash('success', "Account is being generated");
                return redirect()->route('wallet');
            elseif($fetchCustomer->data->identified == 'false'):
                return $this->verifyCustomer($fetchCustomer->data->customer_code, $this->user);
            endif;
        elseif($customerRequest->status == 404):
            return $this->createCustomerProfile($this->user);
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
            session()->flash('error', 'Please setup and fund your wallet');
        else:
            if($this->withdrawalAmount > $this->withdrawableBalance):
                session()->flash('error', 'You do not have enough money in your account for this transaction');
            else:
                // initiate withdrawal request
                $ref = mt_rand();
                $withdrawal = Withdrawal::create([
                    'user_id' => Auth::user()->id,
                    'amount' => $this->withdrawalAmount + 100,
                    'status' => 'pending',
                ]);
                session()->flash('success', 'Withdrawal initiated successfully');
                return redirect()->route('wallet');
            endif;
        endif;
    }

    public function render()
    {

        return view('livewire.wallet')->with(['txs' => $this->txs(), 'credits' => $this->creditTx]);
    }
}
