<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the department can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list departments');
    }

    /**
     * Determine whether the department can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Department  $model
     * @return mixed
     */
    public function view(User $user, Department $model)
    {
        return $user->hasPermissionTo('view departments');
    }

    /**
     * Determine whether the department can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create departments');
    }

    /**
     * Determine whether the department can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Department  $model
     * @return mixed
     */
    public function update(User $user, Department $model)
    {
        return $user->hasPermissionTo('update departments');
    }

    /**
     * Determine whether the department can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Department  $model
     * @return mixed
     */
    public function delete(User $user, Department $model)
    {
        return $user->hasPermissionTo('delete departments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Department  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete departments');
    }

    /**
     * Determine whether the department can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Department  $model
     * @return mixed
     */
    public function restore(User $user, Department $model)
    {
        return false;
    }

    /**
     * Determine whether the department can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Department  $model
     * @return mixed
     */
    public function forceDelete(User $user, Department $model)
    {
        return false;
    }
}
