<?php

namespace App\Http\Livewire\Admin\Finance;

use App\Models\Deposit;
use App\Models\User;
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
        $this->users = User::orderBy('lastName', 'ASC')->get();
        $this->date = now()->format('Y-m-d');
    }

    public function addDeposit()
    {
        $this->validate([
            'user' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
            'receipt' => 'required|image|max:2048',
            'date' => 'required|date',
        ]);
        $receipt = $this->receipt->store('src/public/images', 'public');
        $saveDeposit = Deposit::create([
            'user_id' => $this->user,
            'amount' => $this->amount,
            'description' => $this->description,
            'payment_receipt' => $receipt,
            'date' => $this->date,
            'deposit_by' => auth()->user()->id,
        ]);
        if($saveDeposit):
            $user = User::find($this->user);
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
                [ 'user_id' => $this->user],
                [
                    'user_id' => $this->user,
                    'accountBalance' => $balance + $this->amount,
                ]
            );
            session()->flash('success', 'Deposit added successfully');
            return redirect()->route('deposits');
        else:
            session()->flash('error', 'Something went wrong');
            return redirect()->route('deposits');
        endif;


    }

    public function render()
    {
        return view('livewire.admin.finance.deposits');
    }
}
