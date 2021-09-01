<?php

namespace App\Http\Livewire\Admin;

use App\Models\Package as ModelsPackage;
use Livewire\Component;

class Package extends Component
{
    public ModelsPackage $package; 
    
    public function render()
    {
        return view('livewire.admin.package');
    }
}
