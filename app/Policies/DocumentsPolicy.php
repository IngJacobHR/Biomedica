<?php

namespace App\Policies;

use App\Documents;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Documents  $documents
     * @return mixed
     */
    public function view(User $user, Documents $documents)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Documents  $documents
     * @return mixed
     */
    public function update(User $user, Documents $documents)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Documents  $documents
     * @return mixed
     */
    public function delete(User $user, Documents $documents)
    {
        return ($user->roles==='Manager' or $user->roles==='Admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Documents  $documents
     * @return mixed
     */
    public function restore(User $user, Documents $documents)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Documents  $documents
     * @return mixed
     */
    public function forceDelete(User $user, Documents $documents)
    {
        //
    }
}
