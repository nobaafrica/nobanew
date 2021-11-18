<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Partnership;

class Partnerships extends Component
{
    public $partnerships;

    public function mount()
    {
        $this->partnerships = Partnership::where('isRedeemed', 0)->with('package', 'user')->get();
    }

    public function render()
    {
        return view('livewire.admin.partnerships');
    }
}
