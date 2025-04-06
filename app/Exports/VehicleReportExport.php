<?php

namespace App\Exports;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VehicleReportExport implements FromView
{
    // /**
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function collection()
    // {
    //     return Vehicle::all();
    // }

    public function view(): View
    {
        $vehicles = Vehicle::get();

        $totalVehicles = $vehicles->count();

        $averageAge = round($vehicles->avg(function ($vehicle) {
            return now()->year - $vehicle->year_manufacture;
        }), 1);

        $ownershipCount = $vehicles->groupBy('ownership')->map->count()->toArray();

        return view('exports.vehicles-report', compact(
            'vehicles',
            'totalVehicles',
            'averageAge',
            'ownershipCount'
        ));
    }
}
