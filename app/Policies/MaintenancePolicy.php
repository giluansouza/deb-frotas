<?php

namespace App\Policies;

use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MaintenancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Maintenance $maintenance): bool
    {
        return $user->hasAnyRole(['admin']) || $user->id === $maintenance->authorized_by;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['fleet_manager']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Maintenance $maintenance): bool
    {
        if ($maintenance->status === 'completed') {
            return false;
        }

        return $user->hasAnyRole(['fleet_manager']) || $user->id === $maintenance->authorized_by;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Maintenance $maintenance): bool
    {
        if (in_array($maintenance->status, ['in_progress', 'completed'])) {
            return false;
        }

        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Maintenance $maintenance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Maintenance $maintenance): bool
    {
        return false;
    }
}
