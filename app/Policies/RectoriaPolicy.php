<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rectoria;
use Illuminate\Auth\Access\HandlesAuthorization;

class RectoriaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rectoria can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list rectorias');
    }

    /**
     * Determine whether the rectoria can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rectoria  $model
     * @return mixed
     */
    public function view(User $user, Rectoria $model)
    {
        return $user->hasPermissionTo('view rectorias');
    }

    /**
     * Determine whether the rectoria can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create rectorias');
    }

    /**
     * Determine whether the rectoria can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rectoria  $model
     * @return mixed
     */
    public function update(User $user, Rectoria $model)
    {
        return $user->hasPermissionTo('update rectorias');
    }

    /**
     * Determine whether the rectoria can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rectoria  $model
     * @return mixed
     */
    public function delete(User $user, Rectoria $model)
    {
        return $user->hasPermissionTo('delete rectorias');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rectoria  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete rectorias');
    }

    /**
     * Determine whether the rectoria can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rectoria  $model
     * @return mixed
     */
    public function restore(User $user, Rectoria $model)
    {
        return false;
    }

    /**
     * Determine whether the rectoria can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rectoria  $model
     * @return mixed
     */
    public function forceDelete(User $user, Rectoria $model)
    {
        return false;
    }
}
