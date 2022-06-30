<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AcademicLevel;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicLevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the academicLevel can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list academiclevels');
    }

    /**
     * Determine whether the academicLevel can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicLevel  $model
     * @return mixed
     */
    public function view(User $user, AcademicLevel $model)
    {
        return $user->hasPermissionTo('view academiclevels');
    }

    /**
     * Determine whether the academicLevel can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create academiclevels');
    }

    /**
     * Determine whether the academicLevel can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicLevel  $model
     * @return mixed
     */
    public function update(User $user, AcademicLevel $model)
    {
        return $user->hasPermissionTo('update academiclevels');
    }

    /**
     * Determine whether the academicLevel can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicLevel  $model
     * @return mixed
     */
    public function delete(User $user, AcademicLevel $model)
    {
        return $user->hasPermissionTo('delete academiclevels');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicLevel  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete academiclevels');
    }

    /**
     * Determine whether the academicLevel can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicLevel  $model
     * @return mixed
     */
    public function restore(User $user, AcademicLevel $model)
    {
        return false;
    }

    /**
     * Determine whether the academicLevel can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicLevel  $model
     * @return mixed
     */
    public function forceDelete(User $user, AcademicLevel $model)
    {
        return false;
    }
}
