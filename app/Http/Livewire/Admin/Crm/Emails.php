<?php

namespace App\Http\Livewire\Admin\Crm;

use App\Mail\CrmMail;
use App\Models\CrmSmsEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Emails extends Component
{
    public $emails;
    public $users;
    public $user;
    public $description;
    public $subject;

    public function mount()
    {
       $this->users = User::all();
       $this->emails = CrmSmsEmail::where('type', CrmSmsEmail::EMAIL)->orderBy('created_at', 'DESC')->get();
    }

    public function sendMail()
    {
        $this->validate(['user' => 'required', 'description' => 'required']);
        $user = User::find($this->user);

        CrmSmsEmail::create([
            'user_id' => $this->user,
            'authorized_by' => auth()->user()->id,
            'type' => CrmSmsEmail::EMAIL,
            'subject' => $this->subject,
            'content' => $this->description
        ]);

        Mail::to($user)->queue(new CrmMail($this->description, $this->subject));
        session()->flash('success', 'Email sent successfully');

        return redirect()->route('emails');
    }

    public function render()
    {
        return view('livewire.admin.send-mail');
    }
}
