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
            $mtnNumber = in_array(Str::substr($user->phoneNumber, 0, 4), CrmSmsEmail::MTN_NUMBERS);
            $phoneNumber = '234' . Str::substr($user->phoneNumber, 1);
            if ($mtnNumber) {
                $message = $this->sendTextMessage($phoneNumber, $this->content);
                $status = json_decode($message)->message;
                $sid = json_decode($message)->message_id;
            } else {
                $message = $this->sendMessage($this->content, '+' . $phoneNumber);
                $status = $message->status;
                $sid = $message->sid;
            }
            if ($user && $message) {
                CrmSmsEmail::create([
                    'user_id' => $user->id,
                    'authorized_by' => auth()->user()->id,
                    'type' => CrmSmsEmail::SMS,
                    'content' => $this->content,
                    'status' => $status,
                    'sid' => $sid,
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
            session()->flash('error', $e->getMessage());
        }
        return redirect()->route('sms');
    }

    public function render()
    {
        return view('livewire.admin.sms');
    }
}
