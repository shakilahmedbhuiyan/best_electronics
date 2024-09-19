<?php

namespace App\Livewire\Dash;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dash.dashboard')
        ->layout('layouts.app', ['title' => 'Dashboard']);;
    }
}
