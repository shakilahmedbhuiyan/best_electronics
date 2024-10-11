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
            'id' => 2,
            'name' => 'Apple',
            'route' => 'apple',
            'type' => 'category',
        ],
        [
            'id' => 3,
            'name' => 'Samsung',
            'route' => 'samsung',
            'type' => 'category',
        ],
        [
            'id' => 4,
            'name' =>'Products',
            'route' => 'products.all',
            'type' => 'page',
        ]


    ];


    public function render()
    {
        return view('livewire.guest.components.nav');
    }
}
