<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VehicleUsage;
use Illuminate\Auth\Access\Response;

class VehicleUsagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'unit_manager', 'fleet_manager']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VehicleUsage $usage): bool
    {
        return $this->isRelated($user, $usage);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VehicleUsage $vehicleUsage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VehicleUsage $vehicleUsage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VehicleUsage $vehicleUsage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VehicleUsage $vehicleUsage): bool
    {
        return false;
    }

    public function authorize(User $user, VehicleUsage $usage): bool
    {
        return $user->hasRole('fleet_manager') ||
            ($user->hasRole('unit_manager') && $user->unit_name === $usage->unit_name);
    }

    public function dispatch(User $user, VehicleUsage $usage): bool
    {
        return $user->hasRole('garage_manager');
    }

    public function return(User $user, VehicleUsage $usage): bool
    {
        return $user->hasRole('garage_manager') || $user->id === $usage->driver_id;
    }

    private function isRelated(User $user, VehicleUsage $usage): bool
    {
        return $user->hasRole('admin')
            || $user->id === $usage->requested_by
            || $user->id === $usage->driver_id
            || $user->id === $usage->authorized_by
            || $user->id === $usage->garage_out_by
            || $user->id === $usage->garage_in_by;
    }
}
