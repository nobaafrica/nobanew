<?php

namespace App\Http\Livewire\Admin\Finance;

use App\Models\Deposit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Deposits extends Component
{
    use WithFileUploads;

    public $deposits;
    public $users;
    public $user;
    public $amount;
    public $description;
    public $receipt;
    public $date;

    public function mount()
    {
        $this->deposits = Deposit::with('user', 'admin')->orderBy('deposits.created_at', 'DESC')->get();
        $this->users = User::orderBy('firstName', 'ASC')->get();
        $this->date = now()->format('Y-m-d');
    }

    public function addDeposit()
    {
        $this->validate([
            'user' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
//            'receipt' => 'required|image|max:2048',
            'date' => 'required|date',
        ]);
//        $receipt = $this->receipt->store('src/public/images', 'public');
        $user = User::firstWhere('email', $this->user);
        $wallet = Wallet::firstWhere('user_id', $user->id);
        if ($user && $wallet) {
            $saveDeposit = Deposit::create([
                'user_id' => $user->id,
                'amount' => $this->amount,
                'description' => $this->description,
                'payment_receipt' => '',
                'date' => $this->date,
                'deposit_by' => auth()->user()->id,
            ]);

            if ($saveDeposit) {
                $balance = is_null($user->wallet) ? 0 : $user->wallet->accountBalance;
                $user->transactions()->create([
                    'id' => Str::uuid(),
                    'reference' => mt_rand(),
                    'transactionType' => 'credit',
                    'amount' => $this->amount,
                    'status' => 'success',
                    'payment_method' => 'manual',
                    'time' => now(),
                ]);
                $user->wallet()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'user_id' => $user->id,
                        'accountBalance' => $balance + $this->amount,
                    ]
                );
                session()->flash('success', 'Deposit added successfully');
            } else {
                session()->flash('error', 'Something went wrong');
            }
        } else if (!$wallet) {
            session()->flash('error', "User's details does not exist in the wallet.");
        }
        return redirect()->route('deposits');
    }

    public function render()
    {
        return view('livewire.admin.finance.deposits');
    }
}
