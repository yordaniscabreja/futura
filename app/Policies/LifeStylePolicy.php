<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LifeStyle;
use Illuminate\Auth\Access\HandlesAuthorization;

class LifeStylePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lifeStyle can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list lifestyles');
    }

    /**
     * Determine whether the lifeStyle can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LifeStyle  $model
     * @return mixed
     */
    public function view(User $user, LifeStyle $model)
    {
        return $user->hasPermissionTo('view lifestyles');
    }

    /**
     * Determine whether the lifeStyle can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create lifestyles');
    }

    /**
     * Determine whether the lifeStyle can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LifeStyle  $model
     * @return mixed
     */
    public function update(User $user, LifeStyle $model)
    {
        return $user->hasPermissionTo('update lifestyles');
    }

    /**
     * Determine whether the lifeStyle can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LifeStyle  $model
     * @return mixed
     */
    public function delete(User $user, LifeStyle $model)
    {
        return $user->hasPermissionTo('delete lifestyles');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LifeStyle  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete lifestyles');
    }

    /**
     * Determine whether the lifeStyle can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LifeStyle  $model
     * @return mixed
     */
    public function restore(User $user, LifeStyle $model)
    {
        return false;
    }

    /**
     * Determine whether the lifeStyle can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LifeStyle  $model
     * @return mixed
     */
    public function forceDelete(User $user, LifeStyle $model)
    {
        return false;
    }
}
