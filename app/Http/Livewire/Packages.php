<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class Packages extends Component
{
    use WithPagination;

    protected $packages;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->packages = tap(Package::where('status', 'active')->paginate(10))->map(function ($item) {
                                $item->picture = $item->frontPicture ?? $item->pictures->picture;
                                return $item;
                            });
    }

    public function paginationView()
    {
        return 'components.pagination';
    }

    public function render()
    {
        return view('livewire.packages')->with('packages', $this->packages);
    }
}
