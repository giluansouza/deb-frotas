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

    public $filteredSearch;
    public $filteredMonth;
    public $filteredYear;

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->filteredMonth = $this->month;
        $this->filteredYear = $this->year;
        $this->filteredSearch = '';
    }

    public function applyFilters()
    {
        $this->filteredMonth = $this->month;
        $this->filteredYear = $this->year;
        $this->filteredSearch = $this->search;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->search = '';

        $this->filteredMonth = $this->month;
        $this->filteredYear = $this->year;
        $this->filteredSearch = '';
        $this->resetPage();
    }

    public function render()
    {
        $user = auth()->user();

        $query = Fueling::with(['vehicle', 'driver', 'authorizedBy'])
            ->when($user->hasRole('driver'), function ($q) use ($user) {
                $driverId = $user->driver?->id;
                if ($driverId) {
                    $q->where('driver_id', $driverId);
                } else {
                    $q->whereNull('id');
                }
            })
            ->when($this->filteredSearch, function ($q) {
                $search = trim($this->filteredSearch);
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('vehicle', fn($v) => $v->where('plate', 'ilike', "%{$search}%"))
                        ->orWhereHas('driver', fn($d) => $d->where('name', 'ilike', "%{$search}%"));
                });
            })
            ->when($this->filteredMonth && $this->filteredYear, function ($q) {
                $q->whereMonth('fueled_at', $this->filteredMonth)
                    ->whereYear('fueled_at', $this->filteredYear);
            })
            ->orderByDesc('fueled_at');

        $fuelings = $query->paginate(15);

        $successMessage = session('success');

        return view('livewire.fueling.index', compact('fuelings', 'successMessage'));
    }
}
