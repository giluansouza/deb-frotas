<div class="relative">

    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Relatórios</h2>
        </div>

        {{-- Gráficos --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Litros abastecidos por mês</h2>
                <div class="h-64">
                    <canvas id="fuelChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Custos de manutenção por mês</h2>
                <div class="h-64">
                    <canvas id="maintenanceChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4 md:col-span-2">
                <h2 class="text-lg font-semibold mb-2">Distribuição da frota</h2>
                <div class="h-64 flex justify-center items-center">
                    <canvas id="vehiclesChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Ações rápidas --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-6">
            <a href="{{ route('reports.fuel') }}" class="flex items-center justify-center gap-1 bg-blue-600 text-white p-4 rounded-xl text-center hover:bg-blue-700">
                <flux:icon.fuel /> Relatório de Abastecimentos
            </a>
            <a href="{{ route('reports.vehicles') }}" class="flex items-center justify-center gap-1 bg-blue-600 text-white p-4 rounded-xl text-center hover:bg-blue-700">
                <flux:icon.truck /> Relatório de Veículos
            </a>
            <a href="{{ route('reports.maintenance') }}" class="flex items-center justify-center gap-1 bg-blue-600 text-white p-4 rounded-xl text-center hover:bg-blue-700">
                <flux:icon.wrench /> Relatório de Manutenções
            </a>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let fuelChart, maintenanceChart, vehiclesChart;

    function initializeCharts() {
        // Fuel Chart
        const fuelCtx = document.getElementById('fuelChart').getContext('2d');
        if (fuelChart) fuelChart.destroy();
        fuelChart = new Chart(fuelCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Litros abastecidos',
                    data: [1200, 900, 1500, 800],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)'
                }]
            },
            options: { responsive: true }
        });

        // Maintenance Chart
        const maintenanceCtx = document.getElementById('maintenanceChart').getContext('2d');
        if (maintenanceChart) maintenanceChart.destroy();
        maintenanceChart = new Chart(maintenanceCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Custo (R$)',
                    data: [3000, 1800, 2200, 1600],
                    fill: false,
                    borderColor: 'rgba(139, 92, 246, 1)',
                    tension: 0.1
                }]
            },
            options: { responsive: true }
        });

        // Vehicles Chart
        const vehiclesCtx = document.getElementById('vehiclesChart').getContext('2d');
        if (vehiclesChart) vehiclesChart.destroy();
        vehiclesChart = new Chart(vehiclesCtx, {
            type: 'pie',
            data: {
                labels: ['Próprios', 'Locados', 'Cedidos'],
                datasets: [{
                    label: 'Distribuição da Frota',
                    data: [18, 7, 5],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(234, 179, 8, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ]
                }]
            },
            options: { responsive: true }
        });
    }

    document.addEventListener('livewire:updated', function () {
        initializeCharts();
    });

    document.addEventListener('DOMContentLoaded', function () {
        initializeCharts();
    });
</script>
