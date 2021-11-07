<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Partnership;

class Partnerships extends Component
{
    public $partnerships;

    public function mount()
    {
        $this->partnerships = Partnership::where('isRedeemed', 0)->with('package', 'user')->get()->filter(function ($item) {
            if(!empty($item->package) && $item->package->status != 'disabled'):
                return $item;
            endif;
        });
    }

    public function render()
    {
        return view('livewire.admin.partnerships');
    }
}
