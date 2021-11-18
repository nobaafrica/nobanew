<?php

namespace App\Http\Livewire\Admin\Finance;

use App\Mail\WithdrawalRequestApproved;
use App\Mail\WithdrawalRequestDeclined;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class WithdrawalRequests extends Component
{
    public $withdrawalRequests;

    public function mount()
    {
        $this->withdrawalRequests = Withdrawal::where('status', 'pending')->with('user', 'bank')->get();
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = 'approved';
        $withdrawal->save();
        // fetch user
        $user = User::find($withdrawal->user_id);
        // update balances
        if ($user->wallet->withdrawableBalance > ($withdrawal->amount + 100)):
            $user->wallet->withdrawableBalance -= ($withdrawal->amount + 100);
            // create transaction
            $user->transactions()->create([
                'id' => Str::uuid(),
                'transactionType' => 'debit',
                'amount' => $withdrawal->amount + 100,
                'reference' => mt_rand(),
                'status' => 'success',
                'payment_method' => "bank transfer + transfer charges 100NGN",
                'time' => now(),
            ]);
            Mail::to($user)->queue(new WithdrawalRequestApproved($withdrawal));
            session()->flash('success', 'Withdrawal approved successfully');
            return redirect()->route('withdrawal-requests');
        else:
            Mail::to($user)->queue(new WithdrawalRequestDeclined($withdrawal));
            session()->flash('error', 'Insufficient withdrawable balance');
            return redirect()->route('withdrawal-requests');
        endif;
    }

    public function decline($id)
    {
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = 'declined';
        $withdrawal->save();

        session()->flash('success', 'Withdrawal declined successfully');
        return redirect()->route('withdrawal-requests');


    }

    public function render()
    {
        return view('livewire.admin.finance.withdrawal-requests');
    }
}
