<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class SuspendedUsers extends Component
{
    public $clients;

    public function mount()
    {
        $this->clients = User::onlyTrashed()->where('isAdmin', 0)->with('partnerships', 'wallet')->get();
    }

    public function render()
    {
        return view('livewire.admin.users.suspended-users');
    }
}
