<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EditProfile extends Component
{ 
    public User $user;
    public $firstName;
    public $lastName;
    public $phoneNumber;
    public $address;
    public $email;
    public $birthday;
    public $bvn;
    
    public function mount()
    {
        $this->firstName = $this->user->firstName;
        $this->lastName = $this->user->lastName;
        $this->phoneNumber = $this->user->phoneNumber;
        $this->address = $this->user->address;
        $this->email = $this->user->email;
        $this->birthday = $this->user->birthday;
        $this->bvn = $this->user->bank->first()->bvn;
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
