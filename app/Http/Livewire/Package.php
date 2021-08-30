<?php

namespace App\Http\Livewire;

use App\Models\Package as ModelsPackage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Package extends Component
{
    public ModelsPackage $package;
    public $user;
    public $duration;
    public $price;
    public $unit = 1;
    public $profit;
    public $payout;
    public $commitment;

    public function mount()
    {
        $this->duration = $this->package->duration;
        $this->price = $this->package->price;
        $this->profit = $this->package->profitPercentage;
        $this->payout = $this->price + ($this->price * ($this->package->profitPercentage/100));
        $this->commitment = $this->price * $this->unit;
        $this->user = User::find(Auth::user()->id);
    }

    public function updatedUnit()
    {
        $this->commitment = $this->price * $this->unit;
        $this->payout = $this->commitment + ($this->commitment * ($this->package->profitPercentage/100));
    }

    public function partner()
    {
        if($this->user->wallet->accountBalance >= $this->commitment):
            $ref = Str::uuid();
            $profit = $this->commitment * $this->package->profitPercentage/100;
            $this->user->wallet()->update([
                'accountBalance' => $this->user->wallet->accountBalance - $this->commitment,
                'withdrawableBalance' => $this->user->wallet->withdrawableBalance - $this->commitment
            ]);
            $this->user->partnerships()->create([
                'id' => $ref,
                'package_id' => $this->package->id,
                'package_name' => $this->package->name,
                'amount' => $this->commitment,
                'estimatedPayout' => $this->payout,
                'commodityUnit' => $this->unit,
                'percentageProfit' => $this->profit,
                'payoutDate' => now()->addMonths($this->duration),
                'estimatedProfit' => $profit,
            ]);
            $this->user->transactions()->create([
                'id' => Str::uuid(), 
                'transactionType' => 'debit', 
                'amount' => $this->commitment, 
                'reference' => $ref, 
                'status' => 'success', 
                'payment_method' => 'wallet balance',
                'time' => now(),
            ]);
            if (!empty($this->user->referralCode) && $this->user->partnerships->count() < 1):
                $referrer = User::where('refCode', $this->user->referralCode)->first();
                $bonus = $this->commitment * 2/100;
                $referrer->wallet()->update([
                    'referralBonus' => $bonus,
                    'withdrawableBalance' => $this->user->wallet->withdrawableBalance + $bonus
                ]);
                $referrer->transactions()->create([
                    'id' => Str::uuid(), 
                    'transactionType' => 'credit', 
                    'amount' => $bonus, 
                    'reference' => $ref, 
                    'status' => 'success', 
                    'payment_method' => 'referral bonus',
                    'time' => now(),
                ]);
            endif;
            session()->flash('success', 'You\'ve succesfully partnered with us for this package');
            return redirect()->route('partnerships');
        else:
            session()->flash('error', 'You do not have sufficient funds on your account to complete this transaction');
            return redirect()->route('wallet');
        endif;
    }
    
    public function render()
    {
        return view('livewire.package');
    }
}
