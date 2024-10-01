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
        $this->latestDevices = Cache::flexible('latestDevices',[5,300],
            static fn() => Product::latest()
                ->where('status', true)
                ->where('quantity', '>', 0)
                ->take(4)->get());
    }

    public function render()
    {
        return view('livewire.guest.components.latest-devices');
    }
}
