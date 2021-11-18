<?php

namespace App\Http\Livewire\Admin\Finance;

use App\Models\Withdrawal;
use Livewire\Component;

class WithdrawalRequests extends Component
{
    public $withdrawalRequests;

    public function mount()
    {
        $this->withdrawalRequests = Withdrawal::where('status', 'pending')->with('user', 'bank')->get();
    }

    public function render()
    {
        return view('livewire.admin.finance.withdrawal-requests');
    }
}
