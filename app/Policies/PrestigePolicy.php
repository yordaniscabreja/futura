<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Prestige;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrestigePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the prestige can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list prestiges');
    }

    /**
     * Determine whether the prestige can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prestige  $model
     * @return mixed
     */
    public function view(User $user, Prestige $model)
    {
        return $user->hasPermissionTo('view prestiges');
    }

    /**
     * Determine whether the prestige can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create prestiges');
    }

    /**
     * Determine whether the prestige can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prestige  $model
     * @return mixed
     */
    public function update(User $user, Prestige $model)
    {
        return $user->hasPermissionTo('update prestiges');
    }

    /**
     * Determine whether the prestige can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prestige  $model
     * @return mixed
     */
    public function delete(User $user, Prestige $model)
    {
        return $user->hasPermissionTo('delete prestiges');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prestige  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete prestiges');
    }

    /**
     * Determine whether the prestige can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prestige  $model
     * @return mixed
     */
    public function restore(User $user, Prestige $model)
    {
        return false;
    }

    /**
     * Determine whether the prestige can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prestige  $model
     * @return mixed
     */
    public function forceDelete(User $user, Prestige $model)
    {
        return false;
    }
}
