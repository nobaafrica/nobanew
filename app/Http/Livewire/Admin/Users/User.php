<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Partnership;
use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{ 
    public ModelsUser $user;
    public $partnerships;
     
    public function mount()
    {
        $this->partnerships = Partnership::where('user_id', $this->user->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.users.user');
    }
}
