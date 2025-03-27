<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UsersListing extends Component
{
    public function render()
    {
        $users = User::all();

        return view('livewire.users.users-listing', compact('users'));
    }
}
