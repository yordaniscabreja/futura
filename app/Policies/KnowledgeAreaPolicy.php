<?php

namespace App\Policies;

use App\Models\User;
use App\Models\KnowledgeArea;
use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgeAreaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the knowledgeArea can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list knowledgeareas');
    }

    /**
     * Determine whether the knowledgeArea can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KnowledgeArea  $model
     * @return mixed
     */
    public function view(User $user, KnowledgeArea $model)
    {
        return $user->hasPermissionTo('view knowledgeareas');
    }

    /**
     * Determine whether the knowledgeArea can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create knowledgeareas');
    }

    /**
     * Determine whether the knowledgeArea can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KnowledgeArea  $model
     * @return mixed
     */
    public function update(User $user, KnowledgeArea $model)
    {
        return $user->hasPermissionTo('update knowledgeareas');
    }

    /**
     * Determine whether the knowledgeArea can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KnowledgeArea  $model
     * @return mixed
     */
    public function delete(User $user, KnowledgeArea $model)
    {
        return $user->hasPermissionTo('delete knowledgeareas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KnowledgeArea  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete knowledgeareas');
    }

    /**
     * Determine whether the knowledgeArea can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KnowledgeArea  $model
     * @return mixed
     */
    public function restore(User $user, KnowledgeArea $model)
    {
        return false;
    }

    /**
     * Determine whether the knowledgeArea can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KnowledgeArea  $model
     * @return mixed
     */
    public function forceDelete(User $user, KnowledgeArea $model)
    {
        return false;
    }
}
