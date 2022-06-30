<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Economy;
use Illuminate\Auth\Access\HandlesAuthorization;

class EconomyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the economy can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list economies');
    }

    /**
     * Determine whether the economy can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Economy  $model
     * @return mixed
     */
    public function view(User $user, Economy $model)
    {
        return $user->hasPermissionTo('view economies');
    }

    /**
     * Determine whether the economy can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create economies');
    }

    /**
     * Determine whether the economy can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Economy  $model
     * @return mixed
     */
    public function update(User $user, Economy $model)
    {
        return $user->hasPermissionTo('update economies');
    }

    /**
     * Determine whether the economy can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Economy  $model
     * @return mixed
     */
    public function delete(User $user, Economy $model)
    {
        return $user->hasPermissionTo('delete economies');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Economy  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete economies');
    }

    /**
     * Determine whether the economy can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Economy  $model
     * @return mixed
     */
    public function restore(User $user, Economy $model)
    {
        return false;
    }

    /**
     * Determine whether the economy can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Economy  $model
     * @return mixed
     */
    public function forceDelete(User $user, Economy $model)
    {
        return false;
    }
}
