<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MediaType;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the mediaType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list mediatypes');
    }

    /**
     * Determine whether the mediaType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MediaType  $model
     * @return mixed
     */
    public function view(User $user, MediaType $model)
    {
        return $user->hasPermissionTo('view mediatypes');
    }

    /**
     * Determine whether the mediaType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create mediatypes');
    }

    /**
     * Determine whether the mediaType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MediaType  $model
     * @return mixed
     */
    public function update(User $user, MediaType $model)
    {
        return $user->hasPermissionTo('update mediatypes');
    }

    /**
     * Determine whether the mediaType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MediaType  $model
     * @return mixed
     */
    public function delete(User $user, MediaType $model)
    {
        return $user->hasPermissionTo('delete mediatypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MediaType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete mediatypes');
    }

    /**
     * Determine whether the mediaType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MediaType  $model
     * @return mixed
     */
    public function restore(User $user, MediaType $model)
    {
        return false;
    }

    /**
     * Determine whether the mediaType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MediaType  $model
     * @return mixed
     */
    public function forceDelete(User $user, MediaType $model)
    {
        return false;
    }
}
