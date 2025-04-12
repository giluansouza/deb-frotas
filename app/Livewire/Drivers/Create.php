<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $name, $register, $cpf, $rg, $status;
    public $number_cnh, $first_cnh, $validity_cnh, $category_cnh;

    public ?User $user = null;

    public function mount(?User $user = null)
    {
        $this->user = $user;

        if ($user) {
            $this->name = $user->name;
        }
    }

    protected function rules()
    {
        return [
            'status' => 'required|in:active,inactive',
            'name' => 'required|string|max:255',
            'register' => 'required|string|max:50',
            'cpf' => 'required|string|max:14|unique:drivers,cpf',
            'rg' => 'required|string|max:20',
            'number_cnh' => 'required|string|max:20',
            'first_cnh' => 'required|date',
            'validity_cnh' => 'required|date',
            'category_cnh' => 'required|string|max:5',
        ];
    }

    protected function messages()
    {
        return [
            'status.required' => 'O status do motorista é obrigatório.',
            'name.required' => 'O nome do motorista é obrigatório.',
            'registration_number.required' => 'A matrícula é obrigatória.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'rg.required' => 'O RG é obrigatório.',
            'rg.unique' => 'Este RG já está cadastrado.',
            'number_cnh.required' => 'O número da CNH é obrigatório.',
            'first_cnh.required' => 'A data da 1ª habilitação é obrigatória.',
            'first_cnh.date' => 'A data da 1ª habilitação deve ser válida.',
            'validity_cnh.date' => 'A validade da CNH deve ser uma data válida.',
            'validity_cnh.after_or_equal' => 'A validade da CNH deve ser uma data futura ou igual à data de hoje.',
            'category_cnh.required' => 'A categoria da CNH é obrigatória.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => 'nome do motorista',
            'register' => 'matrícula',
            'cpf' => 'CPF',
            'rg' => 'RG',
            'number_cnh' => 'número da CNH',
            'first_cnh' => 'data da 1ª habilitação',
            'validity_cnh' => 'validade da CNH',
            'category_cnh' => 'categoria da CNH',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        Driver::create([
            ...$validated,
            'user_id' => $this->user?->id,
        ]);

        if ($this->user) {
            $this->user->assignRole('driver');
        }

        return redirect()->route('driver.index')->with('success', 'Motorista cadastrado com sucesso!');
    }

    public function render()
    {
        $statuses = collect(\App\DriverStatus::cases())
            ->mapWithKeys(fn($status) => [$status->value => $status->label()])
            ->toArray();

        return view('livewire.drivers.create', [
            'statuses' => $statuses,
        ]);
    }
}
