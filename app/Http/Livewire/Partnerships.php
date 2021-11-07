<?php

namespace App\Http\Livewire;

use App\Models\Partnership;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Partnerships extends Component
{
    public $partnerships;

    public function mount()
    {
        $this->partnerships = Partnership::where('user_id', Auth::user()->id)->with('package', 'user')->get()->filter(function ($item) {
            if(!empty($item->package) && $item->package->status != 'disabled'):
                return $item;
            endif;
        });
    }

    public function render()
    {
        return view('livewire.partnerships');
    }
}
