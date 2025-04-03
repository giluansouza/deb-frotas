<?php

namespace App\Livewire\Maintenance;

use App\Models\Maintenance;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $maintenanceIdBeingDeleted = 0;
    public bool $showDeleteModal = false;

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
        $query = Maintenance::with(['vehicle', 'authorizedBy'])
            ->when($this->filteredSearch, function ($q) {
                $search = trim($this->filteredSearch);
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('vehicle', fn($v) => $v->where('plate', 'ilike', "%{$search}%"));
                });
            })
            ->when($this->filteredMonth && $this->filteredYear, function ($q) {
                $q->whereMonth('start_date', $this->filteredMonth)
                    ->whereYear('start_date', $this->filteredYear);
            })
            ->orderByDesc('start_date');

        $maintenances = $query->paginate(10);

        $successMessage = session('message');

        return view('livewire.maintenance.index', compact('maintenances', 'successMessage'));
    }

    public function confirmDelete(int $id): void
    {
        logger("Confirm delete triggered for ID: {$id}");

        $this->maintenanceIdBeingDeleted = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        try {
            $maintenance = Maintenance::findOrFail($this->maintenanceIdBeingDeleted);

            $this->authorize('delete', $maintenance);

            $maintenance->delete();

            $this->showDeleteModal = false;
            session()->flash('success', 'Manutenção excluída com sucesso.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao excluir manutenção: ' . $e->getMessage());
        }
    }
}
