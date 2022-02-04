<?php

namespace App\Http\Livewire\Admin\Finance;

use App\Models\User;
use App\Models\Withdrawal;
use Livewire\Component;

class Transfers extends Component
{
    public $transfers;
    public $users;

    public function mount()
    {
        $this->transfers = Withdrawal::where('status', 'approved')->with('user', 'bank')->get();
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.admin.finance.transfers');
    }
}
