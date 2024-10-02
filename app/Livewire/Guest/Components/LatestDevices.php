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
            static fn() => Product::with('brand')
                ->where('status', true)
                ->where('quantity', '>', 0)
                ->orderBy('updated_at', 'desc')
                ->take(8)->get());
        //dd($this->latestDevices);
    }

    public function render()
    {
        return view('livewire.guest.components.latest-devices');
    }
}
