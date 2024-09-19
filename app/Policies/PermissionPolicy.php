<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization; 

    public function create( User $user)
    {
        if ($user->hasRole('super-admin')) {
            return Response::allow();
        } else if ($user->can('permission-create')) {
            return Response::allow();
        } else {
            return Response::deny('You can not create the permission.');
        }
    }
    
    public function update(User $user, Permission $permission)
    {

        if ($user->hasRole('super-admin')) {
            return Response::allow();
        } else if ($user->can('permission-edit') && !$user->hasRole($permission->name)) {
            return Response::allow();
        } else {
            return Response::deny('You can not update the permission.');
        }
    }
}
