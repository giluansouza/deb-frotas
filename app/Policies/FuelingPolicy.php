<?php

namespace App\Policies;

use App\Models\Fueling;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FuelingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'fleet_manager']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Fueling $fueling): bool
    {
        if ($user->hasRole(['admin', 'fleet_manager'])) {
            return true;
        }

        if ($user->hasRole(['driver'])) {
            return $fueling->driver_id === $user->driver->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['fleet_manager']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fueling $fueling): bool
    {
        return $user->hasRole(['fleet_manager']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fueling $fueling): bool
    {
        return $user->hasRole(['fleet_manager']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Fueling $fueling): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Fueling $fueling): bool
    {
        return false;
    }
}
