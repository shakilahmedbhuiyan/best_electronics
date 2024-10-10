<?php

namespace App\Livewire\Guest\Components;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FeaturedBrands extends Component
{
    public $brands;

    public function mount()
    {
        $this->brands = Cache::rememberForever('featured-brands', static function () {
            return Brand::featured()->get();
        });
    }

    public function render()
    {
        return view('livewire.guest.components.featured-brands');
    }
}
