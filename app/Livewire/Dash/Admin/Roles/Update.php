<?php

namespace App\Livewire\Dash\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use WireUi\Traits\WireUiActions;

class Update extends Component
{
    use WireUiActions;

    public Role $role;
    public $permissions;
    public $selectedPermissions, $rolePermissions, $name;


    public function mount(Role $role)
    {
        $this->authorize('update', $role);
        $this->role = $role->load('permissions');
        $this->permissions = Permission::get();
        $this->name = $role->name;
        $this->rolePermissions = $role->permissions->pluck('id')->toArray();
        $r = implode(',', $this->rolePermissions);
        $this->selectedPermissions = explode(",", $r);
    }

    public function render()
    {

        return view('livewire.dash.admin.roles.update', ['header' => 'Update Role'])
            ->layout('layouts.app', ['title' => 'Update Role']);
    }


    public function update(): null
    {
        $this->authorize('update', $this->role);


        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->role->id,
            'selectedPermissions' => 'required',
        ]);


        $this->selectedPermissions = array_map(function ($item) {
            return (int)$item;
        }, $this->selectedPermissions);


        $this->role->update(['name' => $this->name]);
        $this->role->syncPermissions($this->selectedPermissions);

        session()->flash('success', 'Role ' . $this->role->name . ' Updated');

       return $this->redirect(route('admin.roles.index'), navigate: true);
    }
}
