<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Partnership;
use App\Models\User as ModelsUser;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class User extends Component
{ 
    public $user;
    public $partnerships;
     
    public function mount($user)
    {
        $this->user = ModelsUser::withTrashed()->find($user);
        $this->partnerships = Partnership::where('user_id', $user)->get();
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

    public function revokeSuspension()
    {
        if (Auth::user()->isAdmin == 1):
            $this->user->restore();
            session()->flash('success', 'User unsuspended successfully');
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
