<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório Mensal de Feedback</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #222;
            margin: 40px;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .subtitulo {
            font-size: 15px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        thead th {
            background-color: #e0e0e0;
            font-weight: bold;
            font-size: 13px;
            padding: 10px;
            border: 1px solid #aaa;
        }

        tbody td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        tfoot td {
            border: none;
            font-size: 14px;
            font-weight: bold;
            color: #222;
        }
    </style>
</head>

<body>

    <header>
        {{-- <img src="{{ public_path('images/logo.png') }}" alt="Logo" height="60"> --}}
        <h1>Relatório Mensal de Feedback</h1>
        @php
            $meses = [
                1 => 'janeiro', 2 => 'fevereiro', 3 => 'março', 4 => 'abril',
                5 => 'maio', 6 => 'junho', 7 => 'julho', 8 => 'agosto',
                9 => 'setembro', 10 => 'outubro', 11 => 'novembro', 12 => 'dezembro'
            ];

            $dataAtual = \Carbon\Carbon::now();
            $mes = $meses[$dataAtual->month];
            $ano = $dataAtual->year;
        @endphp
        <div class="subtitulo">Mês: {{ ucfirst($mes) }} de {{ $ano }}</div>
    </header>

    <table>
        <thead>
            <tr>
                <th>Classificação</th>
                <th>Intervalo</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bom</td>
                <td>4 a 5</td>
                <td>{{ $relatorio['bons'] }}</td>
            </tr>
            <tr>
                <td>Neutro</td>
                <td>3</td>
                <td>{{ $relatorio['neutros'] }}</td>
            </tr>
            <tr>
                <td>Ruim</td>
                <td>1 a 2</td>
                <td>{{ $relatorio['ruins'] }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right; border-top: 2px solid #444; padding: 12px;">
                    Total
                </td>
                <td style="border-top: 2px solid #444; padding: 12px; text-align: center;">
                    {{ $relatorio['total'] }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="assinatura" style="margin-top: 50px; text-align: right; font-size: 11px; color: #999;">
        Relatório gerado automaticamente em {{ \Carbon\Carbon::now()->format('d/m/Y \à\s H:i') }}
    </div>

</body>

</html>
