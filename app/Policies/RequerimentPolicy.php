<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Requeriment;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequerimentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the requeriment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list requeriments');
    }

    /**
     * Determine whether the requeriment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Requeriment  $model
     * @return mixed
     */
    public function view(User $user, Requeriment $model)
    {
        return $user->hasPermissionTo('view requeriments');
    }

    /**
     * Determine whether the requeriment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create requeriments');
    }

    /**
     * Determine whether the requeriment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Requeriment  $model
     * @return mixed
     */
    public function update(User $user, Requeriment $model)
    {
        return $user->hasPermissionTo('update requeriments');
    }

    /**
     * Determine whether the requeriment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Requeriment  $model
     * @return mixed
     */
    public function delete(User $user, Requeriment $model)
    {
        return $user->hasPermissionTo('delete requeriments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Requeriment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete requeriments');
    }

    /**
     * Determine whether the requeriment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Requeriment  $model
     * @return mixed
     */
    public function restore(User $user, Requeriment $model)
    {
        return false;
    }

    /**
     * Determine whether the requeriment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Requeriment  $model
     * @return mixed
     */
    public function forceDelete(User $user, Requeriment $model)
    {
        return false;
    }
}
