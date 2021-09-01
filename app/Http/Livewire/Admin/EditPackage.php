<?php

namespace App\Http\Livewire\Admin;

use App\Models\Package;
use Livewire\Component;

class EditPackage extends Component
{
    public Package $package;
    public function render()
    {
        return view('livewire.admin.edit-package');
    }
}
