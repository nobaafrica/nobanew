<?php

namespace App\Http\Livewire\Admin;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPackage extends Component
{
    use WithFileUploads;

    public Package $package;
    public $name;
    public $code;
    public $price;
    public $duration;
    public $profit;
    public $picture;
    public $description;

    public function mount()
    {
        $this->name = $this->package->name;
        $this->code = $this->package->commodityCode;
        $this->price = $this->package->price;
        $this->duration = $this->package->duration;
        $this->profit = $this->package->profitPercentage;
        $this->picture = $this->package->frontPicture ?? $this->package->pictures->picture;
    }

    public  function editPackage()
    {
        $package = Package::find($this->package->id);
        $package->name = $this->name;
        $package->commodityCode = $this->code;
        $package->price = $this->price;
        $package->duration = $this->duration;
        $package->profitPercentage = $this->profit;
        $package->info = $this->description;
        $package->save();
        session()->flash('success', 'Package updated successfully');
        return redirect()->route('admin-package', $this->package);
    }

    public function updatePicture()
    {
        $pic = $this->picture->store('src/public/images', 'public');
        $package = Package::find($this->package->id);
        $package->frontPicture = $pic;
        $package->save();
        session()->flash('success', 'Package picture changed successfully');
        return redirect()->route('admin-package', $this->package);
    }

    public function deletePackage()
    {
        $package = Package::find($this->package->id);
        $package->partnerships()->delete();
        $package->delete();
        session()->flash('success', 'Package deleted successfully');
        return redirect()->route('admin-packages', $this->package);
    }

    public function disablePackage()
    {
        $package = Package::find($this->package->id);
        $package->status = 'disabled';
        $package->save();
        session()->flash('success', 'Package disabled successfully');
        return redirect()->route('admin-packages', $this->package);
    }

    public function enablePackage()
    {
        $package = Package::find($this->package->id);
        $package->status = 'active';
        $package->save();
        session()->flash('success', 'Package activated successfully');
        return redirect()->route('admin-packages', $this->package);
    }

    public function render()
    {
        return view('livewire.admin.edit-package');
    }
}
