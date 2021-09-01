<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Package;

class Packages extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function paginationView()
    {
        return 'components.pagination';
    }

    public function render()
    {
        return view('livewire.admin.packages', [
            'packages' => Package::paginate(12),
        ]);
    }
}
