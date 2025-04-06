<table>
    <thead>
        <tr>
            <th colspan="2">Relatório de Manutenções</th>
        </tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <th>Total das manutenções:</th>
            <td>R$ {{ $totalValue }}</td>
        </tr>
        <tr>
            <th>Unidade</th>
            <th>Veículo</th>
            <th>Placa</th>
            <th>Tipo de manutenção</th>
            <th>Serviços</th>
            <th>Data</th>
            <th>Valor (R$)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($maintenancesReport as $report)
            <tr>
                <td>{{ $report['unit'] ?? '-' }}</td>
                <td>{{ $report['vehicle'] }}</td>
                <td>{{ $report['plate'] }}</td>
                <td>{{ $report['type'] ?? '-' }}</td>
                <td>{{ $report['description'] ?? '-' }}</td>
                <td>{{ $report['start_date'] }}</td>
                <td>R$ {{ $report['cost'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>