<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{ 
    use WithFileUploads;

    public User $user;
    public $firstName;
    public $lastName;
    public $phoneNumber;
    public $address;
    public $email;
    public $birthday;
    public $profilePicture;
    
    public function mount()
    {
        $this->firstName = $this->user->firstName;
        $this->lastName = $this->user->lastName;
        $this->phoneNumber = $this->user->phoneNumber;
        $this->address = $this->user->address;
        $this->email = $this->user->email;
        $this->birthday = $this->user->birthday;
    }

    public function updateProfileInfo()
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'email' => $this->email,
            'birthday' => $this->birthday,
        ]);
        session()->flash('success', 'Profile updated successfully');
        return redirect()->route('profile');
    }

    public function updatePicture()
    {
        $user = User::find(Auth::user()->id);
        $pic = $this->profilePicture->store('src/public/images', 'public');
        $user->update([
            'profilePicture' => $pic,
        ]);
        session()->flash('success', 'Profile picture changed successfully');
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
