import Chart from 'chart.js/auto';

if (typeof window.fuelChart === 'undefined') {
    window.fuelChart = null;
    window.maintenanceChart = null;
    window.vehiclesChart = null;
}

window.initializeCharts = function() {
    if (window.fuelChart instanceof Chart) {
        window.fuelChart.destroy();
        window.fuelChart = null;
    }
    if (window.maintenanceChart instanceof Chart) {
        window.maintenanceChart.destroy();
        window.maintenanceChart = null;
    }
    if (window.vehiclesChart instanceof Chart) {
        window.vehiclesChart.destroy();
        window.vehiclesChart = null;
    }

    // Fuel Chart
    const fuelCtx = document.getElementById('fuelChart');
    if (fuelCtx) {
        window.fuelChart = new Chart(fuelCtx.getContext('2d'), {
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
    }

    // Maintenance Chart
    const maintenanceCtx = document.getElementById('maintenanceChart');
    if (maintenanceCtx) {
        window.maintenanceChart = new Chart(maintenanceCtx.getContext('2d'), {
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
    }

    // Vehicles Chart
    const vehiclesCtx = document.getElementById('vehiclesChart');
    if (vehiclesCtx) {
        window.vehiclesChart = new Chart(vehiclesCtx.getContext('2d'), {
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
                }],
            },
            options: { responsive: true }
        });
    }
}

document.addEventListener('livewire:init', () => {
    // window.initializeCharts();

    Livewire.on('render-charts', () => {
        window.initializeCharts();
    });

    Livewire.hook('message.processed', () => {
        window.initializeCharts();
    });
});