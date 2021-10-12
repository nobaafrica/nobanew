<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\PaystackCustomerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class VerifyAccount extends Component
{
    use PaystackCustomerTrait;

    public $nuban;
    public $bank;
    public $bankId;
    public $firstName;
    public $lastName;
    public $phone;
    public $address;
    public $banks = [];
    public $accountName;
    public $email;
    public $birthday;
    public $bvnVerified;
    public $bvn;
    public $bankCode;

    public function mount()
    {
        $this->email = auth()->user()->email;
        Cache::remember('banks', now()->addDays(30), function () {
            return Http::get(config('app.okra_url')."banks/list")->object();
        }); 
        $this->banks = Cache::get('banks')->data->banks;
    }

    public function updatedBankId()
    {
        $getbank = Http::withToken(config('app.okra_secret'))->get(config('app.okra_url')."banks/getById?", [
                        "id" => $this->bankId,
                    ])->object();
        $this->bank = $getbank->data->name;
        $this->bankCode = is_null($getbank->data->alt_sortcode) ? $getbank->data->sortcode : $getbank->data->alt_sortcode;
        $this->banks = Cache::get('banks')->data->banks;
    }

    public function updatedNuban()
    {
        $url = config('app.okra_url')."products/kyc/nuban-verify";
        $request = Http::withToken(config('app.okra_secret'))->post($url, [
            'nuban' => $this->nuban,
            'bank' => $this->bankId,
            'testing' => false,
        ])->object();
        if($request->status == 'success'):
            $data = $request->data->identity;
            $this->firstName = $data->firstname;
            $this->lastName = $data->lastname;
            $this->accountName = $data->fullname;
            $this->phone = $data->phone[0];
            $this->address = $data->address[0];
            $this->birthday = $data->dob;
            $this->bvnVerified = !empty($data->bvn) == true ? 1 : 0;
            $this->bvn = $data->bvn;
        else:
            session()->flash('error', 'Invalid Account Number');
        endif;
        $this->banks = Cache::get('banks')->data->banks;
    }

    public function submit()
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phoneNumber' => is_null($user->phone) ? $this->phone : $user->phone,
            'address' => $this->address,
            'birthday' => $this->birthday,
        ]);
        $user->bank()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nuban' => $this->nuban,
                'bank' => $this->bank,
                'bank_id' => $this->bankId,
                'bvn_verified' => $this->bvnVerified,
                'bvn' => $this->bvn,
                'bank_code' => $this->bankCode,
            ]
        );
        $this->createCustomerProfile($user);
        session()->flash('status', 'Account verified successfully');
        redirect()->route('wallet');
    }

    public function render()
    {
        return view('livewire.verify-account')->with('allbanks', $this->banks);
    }
}
