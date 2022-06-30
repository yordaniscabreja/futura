<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Benefit;
use Illuminate\Auth\Access\HandlesAuthorization;

class BenefitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the benefit can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list benefits');
    }

    /**
     * Determine whether the benefit can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Benefit  $model
     * @return mixed
     */
    public function view(User $user, Benefit $model)
    {
        return $user->hasPermissionTo('view benefits');
    }

    /**
     * Determine whether the benefit can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create benefits');
    }

    /**
     * Determine whether the benefit can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Benefit  $model
     * @return mixed
     */
    public function update(User $user, Benefit $model)
    {
        return $user->hasPermissionTo('update benefits');
    }

    /**
     * Determine whether the benefit can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Benefit  $model
     * @return mixed
     */
    public function delete(User $user, Benefit $model)
    {
        return $user->hasPermissionTo('delete benefits');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Benefit  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete benefits');
    }

    /**
     * Determine whether the benefit can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Benefit  $model
     * @return mixed
     */
    public function restore(User $user, Benefit $model)
    {
        return false;
    }

    /**
     * Determine whether the benefit can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Benefit  $model
     * @return mixed
     */
    public function forceDelete(User $user, Benefit $model)
    {
        return false;
    }
}
