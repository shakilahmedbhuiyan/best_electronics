<?php

namespace App\Livewire\Guest\Components;

use Livewire\Component;

class Nav extends Component
{
    public $navLinks = [
        [
            'id' => 1,
            'name' => 'Home',
            'route' => 'index',
            'type' => 'page',
        ],
        [
            'id' => 4,
            'name' => 'Mobile',
            'route' => 'mobile',
            'type' => 'category',
        ],
        [
            'id' => 5,
            'name' => 'Tablets',
            'route' => 'tablet',
            'type' => 'category',
        ],


    ];


    public function render()
    {
        return view('livewire.guest.components.nav');
    }
}
