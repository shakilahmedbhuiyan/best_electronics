<?php

namespace App\Livewire\Dash\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;
    public $search = '';

    protected $listeners = ['search'];

    public function mount()
    {
        $this->users = User::withRoles()->get();

    }



    public function render()
    {
        return view('livewire.dash.admin.users.index', ['header' => 'User Index'])
            ->layout('layouts.app', ['title' => 'Users']);
    }
}
