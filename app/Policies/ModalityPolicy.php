<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Modality;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModalityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the modality can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list modalities');
    }

    /**
     * Determine whether the modality can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modality  $model
     * @return mixed
     */
    public function view(User $user, Modality $model)
    {
        return $user->hasPermissionTo('view modalities');
    }

    /**
     * Determine whether the modality can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create modalities');
    }

    /**
     * Determine whether the modality can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modality  $model
     * @return mixed
     */
    public function update(User $user, Modality $model)
    {
        return $user->hasPermissionTo('update modalities');
    }

    /**
     * Determine whether the modality can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modality  $model
     * @return mixed
     */
    public function delete(User $user, Modality $model)
    {
        return $user->hasPermissionTo('delete modalities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modality  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete modalities');
    }

    /**
     * Determine whether the modality can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modality  $model
     * @return mixed
     */
    public function restore(User $user, Modality $model)
    {
        return false;
    }

    /**
     * Determine whether the modality can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modality  $model
     * @return mixed
     */
    public function forceDelete(User $user, Modality $model)
    {
        return false;
    }
}
