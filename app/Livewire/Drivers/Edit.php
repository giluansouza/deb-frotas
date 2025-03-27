<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;

class Edit extends Component
{
    public $name, $register, $cpf, $rg;
    public $number_cnh, $first_cnh, $validity_cnh, $category_cnh;

    public Driver $driver;

    public function mount(Driver $driver)
    {
        $this->driver = $driver;

        $this->name = $driver->name;
        $this->register = $driver->register;
        $this->cpf = $driver->cpf;
        $this->rg = $driver->rg;
        $this->number_cnh = $driver->number_cnh;
        $this->first_cnh = $driver->first_cnh?->format('Y-m-d');
        $this->validity_cnh = $driver->validity_cnh?->format('Y-m-d');
        $this->category_cnh = $driver->category_cnh;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'register' => 'required|string|max:50',
            'cpf' => 'required|string|max:14|unique:drivers,cpf,' . $this->driver->id,
            'rg' => 'required|string|max:20',
            'number_cnh' => 'required|string|max:20',
            'first_cnh' => 'required|date',
            'validity_cnh' => 'required|date|after_or_equal:today',
            'category_cnh' => 'required|string|max:5',
        ];
    }

    public function update()
    {
        $data = $this->validate();

        $this->driver->update($data);

        return redirect()->route('driver.index')->with('success', 'Motorista atualizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.drivers.edit');
    }

    public function deleteDriver()
    {
        $this->driver->delete();

        return redirect()->route('driver.index')->with('success', 'Motorista deletado com sucesso!');
    }
}
