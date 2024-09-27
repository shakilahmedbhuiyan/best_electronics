<?php

namespace App\Livewire\Guest\Components;

use App\Models\Brand;
use Livewire\Component;

class FeaturedBrands extends Component
{
    public $brands;

    public function mount()
    {
        $this->brands = Brand::featured()->get();
    }

    public function render()
    {
        return view('livewire.guest.components.featured-brands');
    }
}
