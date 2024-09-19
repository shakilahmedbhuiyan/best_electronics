<?php

namespace App\Livewire\Dash\Products;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dash.products.index', ['header' => ' Products'])
            ->layout('layouts.app', ['title' => 'Products Index']);
    }
}
