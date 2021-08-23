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

    public function partner()
    {
        $user = User::find(Auth::user()->id);
        $estimatedPayout = $this->package->price + ($this->package->price * ($this->package->profitPercentage/100));
        $user->partnerhips()->create([
            'id' => Str::uuid(),
            'package_id' => $this->package->id,
            'package_name' => $this->package->name,
            'amount' => $this->package->price,
            'estimatedPayout' => $estimatedPayout,
            'commodityUnit',
            'percentageProfit',
            'payoutDate',
            'estimatedProfit',
        ]);
    }
    
    public function render()
    {
        return view('livewire.package');
    }
}
