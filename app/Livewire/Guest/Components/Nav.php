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
            'name' => 'About',
            'route' => 'about',
            'type' => 'external',
        ],
        [
            'id' => 3,
            'name' => 'Contact',
            'route' => 'register',
            'type' => 'external',
        ],
        [
            'id' => 4,
            'name' => 'Accessories',
            'route' => 'category1',
            'type' => 'category',
            'dropdown' => [
                [
                    'name' => 'Service 1',
                    'route' => 'service-1',
                    'type' => 'product',
                ],
                [
                    'name' => 'Service 2',
                    'route' => 'service-2',
                    'type' => 'product',
                ],
                [
                    'name' => 'Service 3',
                    'route' => 'service-3',
                    'type' => 'product',
                ],
            ],
        ],
    ];


    public function render()
    {
        return view('livewire.guest.components.nav');
    }
}
