<?php

namespace App\Livewire\Guest\Components;

use App\Models\Product;
use Livewire\Component;

class LatestDevices extends Component
{
    public $latestDevices;

    public function mount()
    {
        $this->latestDevices = Product::latest()
            ->take(4)
            ->with('brand')
            ->get();
    }

    public function render()
    {
        return view('livewire.guest.components.latest-devices');
    }
}
