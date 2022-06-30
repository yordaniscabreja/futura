<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Academy;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the academy can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list academies');
    }

    /**
     * Determine whether the academy can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Academy  $model
     * @return mixed
     */
    public function view(User $user, Academy $model)
    {
        return $user->hasPermissionTo('view academies');
    }

    /**
     * Determine whether the academy can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create academies');
    }

    /**
     * Determine whether the academy can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Academy  $model
     * @return mixed
     */
    public function update(User $user, Academy $model)
    {
        return $user->hasPermissionTo('update academies');
    }

    /**
     * Determine whether the academy can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Academy  $model
     * @return mixed
     */
    public function delete(User $user, Academy $model)
    {
        return $user->hasPermissionTo('delete academies');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Academy  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete academies');
    }

    /**
     * Determine whether the academy can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Academy  $model
     * @return mixed
     */
    public function restore(User $user, Academy $model)
    {
        return false;
    }

    /**
     * Determine whether the academy can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Academy  $model
     * @return mixed
     */
    public function forceDelete(User $user, Academy $model)
    {
        return false;
    }
}
