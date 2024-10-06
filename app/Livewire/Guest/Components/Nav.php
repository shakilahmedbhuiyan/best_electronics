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
            'name' => 'Mobile',
            'route' => 'mobile',
            'type' => 'category',
        ],
        [
            'id' => 3,
            'name' => 'Tablets',
            'route' => 'tablet',
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
