<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Admins extends Component
{
    public $clients;

    public $firstName;
    public $lastName;
    public $email;
    public $phoneNumber;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'phoneNumber' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ];

    public function createAdmin()
    {
        $this->validate();
        $user = User::create([
            'id' => Str::uuid(),
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'password' => Hash::make($this->password),
            'refCode' => Str::limit(uniqid('NA'), 8, ''),
            'referralCode' => NULL,
            'isAdmin' => 1
        ]);   
        if(!empty($user)):
            session()->flash('success', 'Admin profile created!!');
            return redirect()->route('admins');
        else:
            session()->flash('success', 'Unable to created admin profile!!');
            return redirect()->route('admins');
        endif;
    }

    public function mount()
    {
        $this->clients = User::where('isAdmin', '>', 0)->with('partnerships')->get();
    }

    public function render()
    {
        return view('livewire.admin.users.admins');
    }
}
