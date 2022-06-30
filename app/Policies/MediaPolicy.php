<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Media;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the media can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allmedia');
    }

    /**
     * Determine whether the media can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Media  $model
     * @return mixed
     */
    public function view(User $user, Media $model)
    {
        return $user->hasPermissionTo('view allmedia');
    }

    /**
     * Determine whether the media can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allmedia');
    }

    /**
     * Determine whether the media can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Media  $model
     * @return mixed
     */
    public function update(User $user, Media $model)
    {
        return $user->hasPermissionTo('update allmedia');
    }

    /**
     * Determine whether the media can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Media  $model
     * @return mixed
     */
    public function delete(User $user, Media $model)
    {
        return $user->hasPermissionTo('delete allmedia');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Media  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allmedia');
    }

    /**
     * Determine whether the media can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Media  $model
     * @return mixed
     */
    public function restore(User $user, Media $model)
    {
        return false;
    }

    /**
     * Determine whether the media can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Media  $model
     * @return mixed
     */
    public function forceDelete(User $user, Media $model)
    {
        return false;
    }
}
