<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name, $email, $password, $role = 'driver';
    public array $roles = [];

    public function mount()
    {
        $this->roles = [
            'fleet_manager' => 'Gestor da Frota',
            'unit_manager' => 'Gestor da Unidade',
            'garage_manager' => 'Gestor da Garagem',
            'driver' => 'Motorista',
        ];
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:' . implode(',', array_keys($this->roles)),
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        if ($this->role === 'driver') {
            return redirect()->route('driver.create', $user);
        }

        $user->assignRole($this->role);

        return redirect()->route('user.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
