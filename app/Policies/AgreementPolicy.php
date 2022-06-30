<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agreement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgreementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the agreement can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list agreements');
    }

    /**
     * Determine whether the agreement can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agreement  $model
     * @return mixed
     */
    public function view(User $user, Agreement $model)
    {
        return $user->hasPermissionTo('view agreements');
    }

    /**
     * Determine whether the agreement can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create agreements');
    }

    /**
     * Determine whether the agreement can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agreement  $model
     * @return mixed
     */
    public function update(User $user, Agreement $model)
    {
        return $user->hasPermissionTo('update agreements');
    }

    /**
     * Determine whether the agreement can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agreement  $model
     * @return mixed
     */
    public function delete(User $user, Agreement $model)
    {
        return $user->hasPermissionTo('delete agreements');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agreement  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete agreements');
    }

    /**
     * Determine whether the agreement can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agreement  $model
     * @return mixed
     */
    public function restore(User $user, Agreement $model)
    {
        return false;
    }

    /**
     * Determine whether the agreement can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agreement  $model
     * @return mixed
     */
    public function forceDelete(User $user, Agreement $model)
    {
        return false;
    }
}
