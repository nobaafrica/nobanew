<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Package;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Packages extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $name;
    public $code;
    public $price;
    public $duration;
    public $profit;
    public $picture;
    public $description;

    protected $rules = [
        'name' => 'string|required',
        'code' => 'string|required',
        'price' => 'integer|required',
        'duration' => 'integer|required',
        'profit' => 'integer|required',
        'picture' => 'image|max:4096|required',
    ];

    public function addPackage()
    {
        $this->validate();
        $package = new Package;
        $pic = $this->picture->store('src/public/images', 'public');
        $package->id = Str::uuid();
        $package->name = $this->name;
        $package->commodityCode = $this->code;
        $package->price = $this->price;
        $package->duration = $this->duration;
        $package->profitPercentage = $this->profit;
        $package->info = $this->description;
        $package->frontPicture = $pic;
        $package->save();
        session()->flash('success', 'Package created successfully');
        return redirect()->route('admin-packages');
    }

    public function paginationView()
    {
        return 'components.pagination';
    }

    public function render()
    {
        return view('livewire.admin.packages', [
            'packages' => Package::where('status', 'active')->paginate(12),
        ]);
    }
}
