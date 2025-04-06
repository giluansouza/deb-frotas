<table>
    <thead>
        <tr>
            <th colspan="2">Relatório de Veículos</th>
        </tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <th>Total de Veículos:</th>
            <td>{{ $totalVehicles }}</td>
        </tr>
        <tr>
            <th>Tempo Médio da Frota:</th>
            <td>{{ $averageAge }} anos</td>
        </tr>
        <tr>
            <th>Distribuição por Vínculo:</th>
            <td>
                Próprios: {{ $ownershipCount['proprio'] ?? 0 }} |
                Locados: {{ $ownershipCount['locado'] ?? 0 }} |
                Cedidos: {{ $ownershipCount['cedido'] ?? 0 }}
            </td>
        </tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <th>Unidade</th>
            <th>Marca/Modelo</th>
            <th>Placa</th>
            <th>Renavam</th>
            <th>Ano</th>
            <th>Vínculo</th>
            <th>Conservação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->unit->name ?? '-' }}</td>
                <td>{{ $vehicle->brand }}/{{ $vehicle->model }}</td>
                <td>{{ $vehicle->plate }}</td>
                <td>{{ $vehicle->renavam }}</td>
                <td>{{ $vehicle->year_manufacture }} / {{ $vehicle->year_model }}</td>
                <td>{{ ucfirst($vehicle->ownership) }}</td>
                <td>{{ ucfirst($vehicle->conservation_state ?? 'Não informado') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
