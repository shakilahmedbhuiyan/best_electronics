<?php

namespace App\Livewire\Guest\Components;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Models\HomeSlider as SliderModel;

class HomeSlider extends Component
{
    public $sliders;

    public function mount()
    {
        $this->sliders = Cache::rememberForever('home-sliders', function () {
            return SliderModel::active()->get();
        });
    }

    public function render()
    {
        return view('livewire.guest.components.home-slider');
    }
}
