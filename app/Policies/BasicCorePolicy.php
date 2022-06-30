<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BasicCore;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasicCorePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the basicCore can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list basiccores');
    }

    /**
     * Determine whether the basicCore can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BasicCore  $model
     * @return mixed
     */
    public function view(User $user, BasicCore $model)
    {
        return $user->hasPermissionTo('view basiccores');
    }

    /**
     * Determine whether the basicCore can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create basiccores');
    }

    /**
     * Determine whether the basicCore can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BasicCore  $model
     * @return mixed
     */
    public function update(User $user, BasicCore $model)
    {
        return $user->hasPermissionTo('update basiccores');
    }

    /**
     * Determine whether the basicCore can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BasicCore  $model
     * @return mixed
     */
    public function delete(User $user, BasicCore $model)
    {
        return $user->hasPermissionTo('delete basiccores');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BasicCore  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete basiccores');
    }

    /**
     * Determine whether the basicCore can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BasicCore  $model
     * @return mixed
     */
    public function restore(User $user, BasicCore $model)
    {
        return false;
    }

    /**
     * Determine whether the basicCore can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BasicCore  $model
     * @return mixed
     */
    public function forceDelete(User $user, BasicCore $model)
    {
        return false;
    }
}
