<?php

namespace App\Livewire\Dash\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use WireUi\Traits\WireUiActions;

class Create extends Component
{

    use WireUiActions;

    public $name;
    public $permissions = [];


    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(): null
    {
        $this->authorize('create', Role::class);

        $validated = $this->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $this->permissions = array_map(function ($item) {
            return (int)$item;
        }, $this->permissions);

        $role = Role::create(['guard_name' => 'web', 'name' => $validated['name']]);
        $role->syncPermissions($this->permissions);
        $this->notification()->success(
            $title = 'Role ' . $role->name . ' Created',
            $description = 'Role created successfully'
        );
        sleep(0.7);

        return $this->redirect(route('admin.roles.index'), navigate: true);
    }

    public function render()
    {
        $permission = Permission::all();

        return view(
            'livewire.dash.admin.roles.create',
            ['header' => 'Create Role'],
            compact('permission')
        )->layout('layouts.app', ['title' => 'Create Role']);
    }
}
