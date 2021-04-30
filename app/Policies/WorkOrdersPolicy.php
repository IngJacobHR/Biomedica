<?php

namespace App\Policies;

use App\User;
use App\WorkOrders;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrdersPolicy
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
     * @param  \App\WorkOrders  $workOrders
     * @return mixed
     */
    public function view(User $user, WorkOrders $workOrders)
    {
        return ($user->roles==='Manager' or $user->roles==='Admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->roles==='Manager' or $user->roles==='Operativo');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\WorkOrders  $workOrders
     * @return mixed
     */
    public function update(User $user, WorkOrders $workOrders)
    {
        return $user->roles==='Manager';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\WorkOrders  $workOrders
     * @return mixed
     */
    public function delete(User $user, WorkOrders $workOrders)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\WorkOrders  $workOrders
     * @return mixed
     */
    public function restore(User $user, WorkOrders $workOrders)
    {
        return ($user->roles==='Manager' or $user->roles==='Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\WorkOrders  $workOrders
     * @return mixed
     */
    public function forceDelete(User $user, WorkOrders $workOrders)
    {
        //
    }
}
