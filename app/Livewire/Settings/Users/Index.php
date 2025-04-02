<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $users = User::all();

        $successMessage = session('success');

        return view('livewire.settings.users.index', compact('users', 'successMessage'));
    }
}
