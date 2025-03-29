<?php

namespace App\Livewire\Fueling;

use App\Models\Fueling;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $month;
    public $year;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedMonth()
    {
        $this->resetPage();
    }
    public function updatedYear()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Fueling::with(['vehicle', 'driver', 'authorizedBy'])
            ->when($this->search, function ($q) {
                $q->whereHas('vehicle', fn($v) => $v->where('plate', 'ilike', "%{$this->search}%"))
                    ->orWhereHas('driver', fn($d) => $d->where('name', 'ilike', "%{$this->search}%"));
            })
            ->when($this->month && $this->year, function ($q) {
                $q->whereMonth('fueled_at', $this->month)
                    ->whereYear('fueled_at', $this->year);
            })
            ->orderByDesc('fueled_at');

        $fuelings = $query->paginate(15);

        return view('livewire.fueling.index', compact('fuelings'));
    }
}
