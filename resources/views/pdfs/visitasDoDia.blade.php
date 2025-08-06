<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Relatório de Visitas do Dia</title>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 11px;
        margin: 30px;
        color: #2c3e50;
    }
    h1 {
        font-size: 20px;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        text-align: center;
        margin-bottom: 30px;
    }
    h2 {
        font-size: 16px;
        margin-top: 30px;
        border-bottom: 1px solid #999;
        padding-bottom: 5px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 10px;
    }
    th, td {
        border: 1px solid #999;
        padding: 5px 6px;
        text-align: left;
        vertical-align: middle;
        word-wrap: break-word;
    }
    th {
        background-color: #eaecee;
        font-weight: bold;
        text-align: center;
    }
    tbody tr:nth-child(even) {
        background-color: #f8f9f9;
    }
    .center {
        text-align: center;
    }
    .badge-status {
        padding: 3px 7px;
        color: white;
        border-radius: 4px;
        display: inline-block;
    }
    .pendente { background-color: #f0ad4e; }
    .aprovada { background-color: #5cb85c; }
    .recusada { background-color: #d9534f; }
    .encerrada { background-color: #6c757d; }
</style>
</head>
<body>

<h1>Relatório de Visitas do Dia ({{ \Carbon\Carbon::now()->format('d/m/Y') }})</h1>

@php
    use Carbon\Carbon;
    $groupedVisitas = $visitasDoDia->groupBy(function($item) {
        return $item->instituicao ?? 'Sem Instituição';
    });
@endphp

@foreach($groupedVisitas as $instituicao => $visitasInstituicao)
    <h2>Instituição: {{ $instituicao }}</h2>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Status</th>
                <th>Telefone</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitasInstituicao as $visita)
                <tr>
                    <td>{{ $visita->nome ?? 'N/A' }}</td>
                    <td>{{ $visita->cpf ?? 'N/A' }}</td>
                    <td>{{ $visita->rg ?? 'N/A' }}</td>
                    <td class="center">
                        <span class="badge-status {{ strtolower($visita->status ?? '') }}">
                            {{ ucfirst($visita->status ?? 'N/A') }}
                        </span>
                    </td>
                    <td>{{ $visita->telefone ?? 'N/A' }}</td>
                    <td>{{ $visita->motivo ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

</body>
</html>
