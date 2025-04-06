<table>
    <thead>
        <tr>
            <th colspan="10" style="text-align: center; font-weight: bold; font-size: 16px;">
                Relatório de Abastecimento - {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}/{{ $year }}
            </th>
        </tr>
        <tr><td colspan="10"></td></tr>
        <tr style="background-color: #f3f4f6; font-weight: bold;">
            <th>Unidade</th>
            <th>Veículo</th>
            <th>Placa</th>
            <th>Tipo de Combustível</th>
            <th>Litros</th>
            <th>Valor Total (R$)</th>
            <th>KM Inicial</th>
            <th>KM Final</th>
            <th>KM Rodado</th>
            <th>Consumo Médio (km/l)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicleReports as $report)
            <tr>
                <td>{{ $report['unit'] }}</td>
                <td>{{ $report['vehicle'] }}</td>
                <td>{{ $report['plate'] }}</td>
                <td>{{ ucfirst($report['fuel_type']) }}</td>
                <td>{{ number_format($report['liters'], 2, ',', '.') }}</td>
                <td>{{ number_format($report['cost'], 2, ',', '.') }}</td>
                <td>{{ $report['km_start'] ?? 'NI' }}</td>
                <td>{{ $report['km_end'] ?? 'NI' }}</td>
                <td>
                    @if(!is_null($report['km_driven']))
                        {{ $report['km_driven'] }}
                    @else
                        NI
                    @endif
                </td>
                <td>
                    @if(!is_null($report['average_consumption']))
                        {{ $report['average_consumption'] }}
                    @else
                        NI
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
