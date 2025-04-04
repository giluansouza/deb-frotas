<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewReports(User $user): bool
    {
        return $user->hasRole(['admin', 'fleet_manager']);
    }
}
