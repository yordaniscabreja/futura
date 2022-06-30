<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AcademicProgram;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicProgramPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the academicProgram can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list academicprograms');
    }

    /**
     * Determine whether the academicProgram can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicProgram  $model
     * @return mixed
     */
    public function view(User $user, AcademicProgram $model)
    {
        return $user->hasPermissionTo('view academicprograms');
    }

    /**
     * Determine whether the academicProgram can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create academicprograms');
    }

    /**
     * Determine whether the academicProgram can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicProgram  $model
     * @return mixed
     */
    public function update(User $user, AcademicProgram $model)
    {
        return $user->hasPermissionTo('update academicprograms');
    }

    /**
     * Determine whether the academicProgram can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicProgram  $model
     * @return mixed
     */
    public function delete(User $user, AcademicProgram $model)
    {
        return $user->hasPermissionTo('delete academicprograms');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicProgram  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete academicprograms');
    }

    /**
     * Determine whether the academicProgram can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicProgram  $model
     * @return mixed
     */
    public function restore(User $user, AcademicProgram $model)
    {
        return false;
    }

    /**
     * Determine whether the academicProgram can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AcademicProgram  $model
     * @return mixed
     */
    public function forceDelete(User $user, AcademicProgram $model)
    {
        return false;
    }
}
