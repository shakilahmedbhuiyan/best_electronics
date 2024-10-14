<?php

namespace App\Livewire\Guest\Components;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class LatestDevices extends Component
{
    public $latestDevices;

    public function mount()
    {
        if(cache()->has('latestDevices')) {
            $this->latestDevices = \cache()->get('latestDevices');
        }
        else {
            $this->latestDevices = Product::with('brand')
                ->where('status', true)
                ->where('quantity', '>', 0)
                ->orderBy('updated_at', 'desc')
                ->take(8)
                ->get();
            Cache::forever('latestDevices', $this->latestDevices);
        }
    }

    public function render()
    {
        return view('livewire.guest.components.latest-devices');
    }
}
