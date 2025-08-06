<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visita #{{ $visita->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 15px;
            width: 100%;
        }

        .label {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .text-box {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fafafa;
            white-space: pre-wrap; 
            min-height: 60px; 
            font-size: 12px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table td, table th {
            padding: 6px;
            border: 1px solid #ccc;
            vertical-align: top;
        }

        .imagem img {
            max-height: 100px;
            max-width: 100%;
        }
    </style>
</head>
<body>

    <h2>Detalhes da Visita #{{ $visita->id }}</h2>

    <div class="section">
        <strong>Informações Principais</strong>
        <table>
            <tr>
                <td class="label">Nome</td>
                <td>{{ $visita->nome }}</td>
                <td class="label">Instituição</td>
                <td>{{ $visita->instituicao ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">CPF</td>
                <td>{{ $visita->cpf ?? '-' }}</td>
                <td class="label">RG</td>
                <td>{{ $visita->rg ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Telefone</td>
                <td>{{ $visita->telefone ?? '-' }}</td>
                <td class="label">Status</td>
                <td>{{ $visita->status}}</td>
            </tr>
        </table>
    </div>

    <div class="section text-center">
        <strong>Foto da Visita</strong><br><br>
        @if($visita->foto)
            <img src="{{ public_path('storage/' . $visita->foto) }}" alt="Foto da Visita">
        @else
            <span>Sem foto cadastrada.</span>
        @endif
    </div>

    <div class="section">
        <strong>Motivo da Visita</strong><br>
        <div class="text-box">{{ $visita->motivo ?? 'Nenhum motivo informado.' }}</div>
    </div>

</body>
</html>
