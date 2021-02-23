<?php

namespace App\Policies;

use App\Prospecto;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProspectoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any prospectos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the prospecto.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function view(User $user, Prospecto $prospecto)
    {
        return true;
    }

    /**
     * Determine whether the user can create prospectos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the prospecto.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function update(User $user, Prospecto $prospecto)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the prospecto.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function delete(User $user, Prospecto $prospecto)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the prospecto.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function restore(User $user, Prospecto $prospecto)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the prospecto.
     *
     * @param  \App\User  $user
     * @param  \App\Prospecto  $prospecto
     * @return mixed
     */
    public function forceDelete(User $user, Prospecto $prospecto)
    {
        return true;
    }
}
