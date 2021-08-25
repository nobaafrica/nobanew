<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;

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
        return view('livewire.packages', [
            'packages' => Package::paginate(12),
        ]);
    }
}
