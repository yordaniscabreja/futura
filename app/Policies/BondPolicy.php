<?php

namespace App\Policies;

use App\Models\Bond;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BondPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bond can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list bonds');
    }

    /**
     * Determine whether the bond can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bond  $model
     * @return mixed
     */
    public function view(User $user, Bond $model)
    {
        return $user->hasPermissionTo('view bonds');
    }

    /**
     * Determine whether the bond can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create bonds');
    }

    /**
     * Determine whether the bond can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bond  $model
     * @return mixed
     */
    public function update(User $user, Bond $model)
    {
        return $user->hasPermissionTo('update bonds');
    }

    /**
     * Determine whether the bond can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bond  $model
     * @return mixed
     */
    public function delete(User $user, Bond $model)
    {
        return $user->hasPermissionTo('delete bonds');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bond  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete bonds');
    }

    /**
     * Determine whether the bond can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bond  $model
     * @return mixed
     */
    public function restore(User $user, Bond $model)
    {
        return false;
    }

    /**
     * Determine whether the bond can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bond  $model
     * @return mixed
     */
    public function forceDelete(User $user, Bond $model)
    {
        return false;
    }
}
