<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wellness;
use Illuminate\Auth\Access\HandlesAuthorization;

class WellnessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wellness can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list wellnesses');
    }

    /**
     * Determine whether the wellness can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wellness  $model
     * @return mixed
     */
    public function view(User $user, Wellness $model)
    {
        return $user->hasPermissionTo('view wellnesses');
    }

    /**
     * Determine whether the wellness can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create wellnesses');
    }

    /**
     * Determine whether the wellness can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wellness  $model
     * @return mixed
     */
    public function update(User $user, Wellness $model)
    {
        return $user->hasPermissionTo('update wellnesses');
    }

    /**
     * Determine whether the wellness can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wellness  $model
     * @return mixed
     */
    public function delete(User $user, Wellness $model)
    {
        return $user->hasPermissionTo('delete wellnesses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wellness  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete wellnesses');
    }

    /**
     * Determine whether the wellness can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wellness  $model
     * @return mixed
     */
    public function restore(User $user, Wellness $model)
    {
        return false;
    }

    /**
     * Determine whether the wellness can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wellness  $model
     * @return mixed
     */
    public function forceDelete(User $user, Wellness $model)
    {
        return false;
    }
}
