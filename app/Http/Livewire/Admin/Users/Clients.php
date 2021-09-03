<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Clients extends Component
{
    public $clients;

    public function mount()
    {
        $this->clients = User::where('isAdmin', 0)->with('partnerships')->get();
    }
    
    public function render()
    {
        return view('livewire.admin.users.clients');
    }
}
