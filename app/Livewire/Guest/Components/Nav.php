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
            'name' => 'Laptop',
            'route' => 'laptop',
            'type' => 'category',
        ],
        [
            'id' => 3,
            'name' => 'Mobile',
            'route' => 'mobile',
            'type' => 'category',
        ],
        [
            'id' => 4,
            'name' => 'Mobile',
            'route' => 'mobile',
            'type' => 'category',
        ],
        [
            'id' => 5,
            'name' => 'Accessories',
            'route' => 'accessories',
            'type' => 'category',
        ],
        [
            'id' => 6,
            'name' => 'Contact',
            'route' => '/contact',
            'type' => 'external',
        ],
    ];


    public function render()
    {
        return view('livewire.guest.components.nav');
    }
}
