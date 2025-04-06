<?php

namespace App\Livewire\Reports;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Relatórios')]
/**
 * Class Index
 *
 * @package App\Livewire\Reports
 */
class Index extends Component
{
    public function mount()
    {
        $this->dispatch('render-charts');
    }

    public function render()
    {
        return view('livewire.reports.index');
    }
}
