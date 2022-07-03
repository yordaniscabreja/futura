<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Convenio;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConvenioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the convenio can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list convenios');
    }

    /**
     * Determine whether the convenio can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convenio  $model
     * @return mixed
     */
    public function view(User $user, Convenio $model)
    {
        return $user->hasPermissionTo('view convenios');
    }

    /**
     * Determine whether the convenio can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create convenios');
    }

    /**
     * Determine whether the convenio can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convenio  $model
     * @return mixed
     */
    public function update(User $user, Convenio $model)
    {
        return $user->hasPermissionTo('update convenios');
    }

    /**
     * Determine whether the convenio can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convenio  $model
     * @return mixed
     */
    public function delete(User $user, Convenio $model)
    {
        return $user->hasPermissionTo('delete convenios');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convenio  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete convenios');
    }

    /**
     * Determine whether the convenio can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convenio  $model
     * @return mixed
     */
    public function restore(User $user, Convenio $model)
    {
        return false;
    }

    /**
     * Determine whether the convenio can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convenio  $model
     * @return mixed
     */
    public function forceDelete(User $user, Convenio $model)
    {
        return false;
    }
}
