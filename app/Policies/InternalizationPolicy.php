<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Internalization;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternalizationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the internalization can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list internalizations');
    }

    /**
     * Determine whether the internalization can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Internalization  $model
     * @return mixed
     */
    public function view(User $user, Internalization $model)
    {
        return $user->hasPermissionTo('view internalizations');
    }

    /**
     * Determine whether the internalization can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create internalizations');
    }

    /**
     * Determine whether the internalization can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Internalization  $model
     * @return mixed
     */
    public function update(User $user, Internalization $model)
    {
        return $user->hasPermissionTo('update internalizations');
    }

    /**
     * Determine whether the internalization can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Internalization  $model
     * @return mixed
     */
    public function delete(User $user, Internalization $model)
    {
        return $user->hasPermissionTo('delete internalizations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Internalization  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete internalizations');
    }

    /**
     * Determine whether the internalization can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Internalization  $model
     * @return mixed
     */
    public function restore(User $user, Internalization $model)
    {
        return false;
    }

    /**
     * Determine whether the internalization can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Internalization  $model
     * @return mixed
     */
    public function forceDelete(User $user, Internalization $model)
    {
        return false;
    }
}
