<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Partnership;
use App\Models\User as ModelsUser;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class User extends Component
{ 
    public ModelsUser $user;
    public $partnerships;
     
    public function mount()
    {
        $this->partnerships = Partnership::where('user_id', $this->user->id)->get();
    }

    public function suspend()
    {
        if (Auth::user()->isAdmin == 1):
            $this->user->delete();
            session()->flash('success', 'User suspended successfully');
            return redirect()->route('clients');
        else:
            session()->flash('error', 'You\'re not authorized to perform this action');
            return redirect()->route('clients');
        endif;
    }

    public function render()
    {
        return view('livewire.admin.users.user');
    }
}
