<?php

namespace App\Livewire\Guest\Components;


use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AppleDevices extends Component
{
    public  $devices=[];
    public $brand;
    public $cache = false;

    public function mount($brand)
    {
        if (Cache::has('brand_' . $brand)) {
            $this->brand = Cache::get('brand_' . $brand);
        } else {
            $this->brand = Brand::where('name', $brand)->first();
            Cache::forever('brand_' . $brand, $this->brand);
        }
      if ($this->brand) {

          $key = $this->brand->slug . '_devices';

          if (Cache::has($key)) {
              $this->devices = Cache::get($key);
              $this->cache = true;
          } else {
              $this->devices = Product::where('brand_id', $this->brand->id)
                  ->where('status', true)
                  ->where('quantity', '>', 0)
                  ->orderBy('created_at', 'desc')
                  ->with('brand')
                  ->limit(4)
                  ->get();
              Cache::forever($key, $this->devices);
          }
      }

        return $this->devices;
    }

    public function render()
    {

        return view('livewire.guest.components.apple-devices');
    }
}
