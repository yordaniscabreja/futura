<?php

namespace App\Policies;

use App\Models\Beca;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BecaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the beca can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list becas');
    }

    /**
     * Determine whether the beca can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beca  $model
     * @return mixed
     */
    public function view(User $user, Beca $model)
    {
        return $user->hasPermissionTo('view becas');
    }

    /**
     * Determine whether the beca can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create becas');
    }

    /**
     * Determine whether the beca can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beca  $model
     * @return mixed
     */
    public function update(User $user, Beca $model)
    {
        return $user->hasPermissionTo('update becas');
    }

    /**
     * Determine whether the beca can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beca  $model
     * @return mixed
     */
    public function delete(User $user, Beca $model)
    {
        return $user->hasPermissionTo('delete becas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beca  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete becas');
    }

    /**
     * Determine whether the beca can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beca  $model
     * @return mixed
     */
    public function restore(User $user, Beca $model)
    {
        return false;
    }

    /**
     * Determine whether the beca can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beca  $model
     * @return mixed
     */
    public function forceDelete(User $user, Beca $model)
    {
        return false;
    }
}
