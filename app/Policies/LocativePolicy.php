<?php

namespace App\Policies;

use App\Locative;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocativePolicy
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
     * @param  \App\Locative  $locative
     * @return mixed
     */
    public function view(User $user, Locative $locative)
    {
        return ($user->roles==='S.Admin' or $user->roles==='Auxiliar');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->roles==='S.Admin' or $user->roles==='Operativo');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Locative  $locative
     * @return mixed
     */
    public function update(User $user, Locative $locative)
    {
        //return ($user->roles==='S.Admin' or $user->roles==='Auxiliar');
        return $user->roles==='S.Admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Locative  $locative
     * @return mixed
     */
    public function delete(User $user, Locative $locative)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Locative  $locative
     * @return mixed
     */
    public function restore(User $user, Locative $locative)
    {
        return ($user->roles==='S.Admin' or $user->roles==='Auxiliar');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Locative  $locative
     * @return mixed
     */
    public function forceDelete(User $user, Locative $locative)
    {
        //
    }
}
