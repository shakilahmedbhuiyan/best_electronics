<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization; 


    public function create(User $user): Response
    {

        return $user->hasRole('super-admin')
            ? Response::allow()
            : Response::deny('You do not have permission to create roles');
    }

    public function update(User $user, Role $role)
    {
        if ($user->hasRole('super-admin')) {
            return Response::allow();
        } else if ($user->can('role-edit') && !$user->hasRole($role->name) && $role->name !== 'super-admin') {
            return Response::allow();
        } else {
            return Response::deny('You can not update the role.');
        }
    }

    public function delete(User $user, Role $role)
    {

        if ($user->hasRole('super-admin') && $role->name !== 'super-admin') {
            return Response::allow();
        } else if ($user->can('role-delete') && !$user->hasRole($role->name) && $role->name !== 'super-admin') {
            return Response::allow();
        } else {
            return Response::deny('You can not delete the role.');
        }
    }
}
