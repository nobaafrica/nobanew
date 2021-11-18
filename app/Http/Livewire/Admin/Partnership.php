<?php

namespace App\Http\Livewire\Admin;

use App\Models\Partnership as ModelsPartnership;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class Partnership extends Component
{
    public ModelsPartnership $partnership;

    public function redeem()
    {
        $partnership = ModelsPartnership::find($this->partnership->id);
        $partnership->isRedeemed = 1;
        $partnership->save();
        $user = User::find($partnership->user->id);
        $user->wallet()->update([
            'withdrawableBalance' =>  $user->wallet->withdrawableBalance + $this->partnership->estimatedPayout,
        ]);
        $user->transactions()->create([
            'id' => Str::uuid(),
            'transactionType' => 'credit',
            'amount' => $this->partnership->estimatedPayout,
            'reference' => $partnership->id,
            'status' => 'success',
            'time' => now(),
        ]);
        session()->flash('success', 'Partnership redeemed successfully');
        return redirect()->route('admin-packages');
    }

    public function render()
    {
        return view('livewire.admin.partnership');
    }
}
