<?php

namespace App\Http\Livewire\Admin\Crm;

use App\Models\CrmSmsEmail;
use App\Models\User;
use App\Traits\SendSMSTrait;
use Illuminate\Support\Str;
use Livewire\Component;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;

class Sms extends Component
{
    use SendSMSTrait;

    public $users;
    public $sms;
    public $phoneNumber;
    public $content;

    public function mount()
    {
        $this->users = User::all();
        $this->sms = CrmSmsEmail::where('type', CrmSmsEmail::SMS)->orderBy('created_at', 'DESC')->get();
    }

    public function sendSms()
    {
        try {
            $user = User::where('phoneNumber', $this->phoneNumber)->where('phoneNumber', '!=', null)->first();
            $message = $this->sendMessage($this->content, '+234' . Str::substr($user->phoneNumber, 1));
            if ($user && $message) {
                CrmSmsEmail::create([
                    'user_id' => $this->userId,
                    'authorized_by' => auth()->user()->id,
                    'type' => CrmSmsEmail::SMS,
                    'content' => $this->content,
                    'status' => $message->status,
                    'sid' => $message->sid,
                ]);
                session()->flash('success', 'SMS sent successfully');
            } else {
                session()->flash('error', 'User not found.');
            }
        } catch (ConfigurationException|TwilioException $e) {
            CrmSmsEmail::create([
                'user_id' => $user->id,
                'authorized_by' => auth()->user()->id,
                'type' => CrmSmsEmail::SMS,
                'content' => $this->content,
                'status' => $e->getMessage()
            ]);
            session()->flash('error', 'There was an issue trying to send the text message');
        }
        return redirect()->route('sms');
    }

    public function render()
    {
        return view('livewire.admin.sms');
    }
}
