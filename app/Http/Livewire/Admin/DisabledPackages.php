<?php

namespace App\Http\Livewire\Admin;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DisabledPackages extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public function paginationView()
    {
        return 'components.pagination';
    }

    public function render()
    {
        return view('livewire.admin.disabled-packages', [
            'packages' => tap(Package::where('status', 'disabled')->paginate(10))->map(function ($item) {
                $item->picture = $item->frontPicture ?? $item->pictures->picture;
                return $item;
            }),
        ]);
    }
}
