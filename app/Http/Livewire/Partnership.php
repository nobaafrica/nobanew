<?php

namespace App\Http\Livewire;

use App\Models\Partnership as ModelsPartnership;
use Livewire\Component;

class Partnership extends Component
{
    public ModelsPartnership $partnership;
    
    public function render()
    {
        return view('livewire.partnership');
    }
}
