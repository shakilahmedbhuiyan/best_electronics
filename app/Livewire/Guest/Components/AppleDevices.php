<?php

namespace App\Livewire\Guest\Components;


use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AppleDevices extends Component
{
    public $devices;
    public $brand;

    public function mount($brand)
    {
        $key = 'brand_' . $brand;

        $this->brand = cache::rememberForever($key, function () use ($brand) {
            return Brand::where('name', $brand)->first();
        });
        $this->devices = Product::where('brand_id', $this->brand->id)
            ->where('status', true)
            ->where('quantity', '>', 0)
            ->orderBy('created_at', 'desc')
            ->with('brand')
            ->limit(4)
            ->get();

        Cache::rememberForever($this->brand->slug.'_devices', function () {
            return $this->devices;
        });
    }

    public function render()
    {
        return view('livewire.guest.components.apple-devices');
    }
}
