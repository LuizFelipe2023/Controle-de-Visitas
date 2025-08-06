document.addEventListener('DOMContentLoaded', function () {
    if (typeof chartData !== 'undefined') {
        const safeArray = (arr) => Array.isArray(arr) ? arr : [];

        Highcharts.chart('visitasPorDiaChart', {
            chart: { type: 'column' },
            title: { text: 'Visitas nos últimos dias' },
            xAxis: {
                categories: safeArray(chartData.por_dia).map(item => item.data),
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: { text: 'Quantidade' }
            },
            series: [{
                name: 'Visitas',
                data: safeArray(chartData.por_dia).map(item => item.total)
            }]
        });

        Highcharts.chart('visitasPorInstituicaoChart', {
            chart: { type: 'pie' },
            title: { text: 'Distribuição por Instituição' },
            series: [{
                name: 'Visitas',
                colorByPoint: true,
                data: safeArray(chartData.por_instituicao).map(item => ({
                    name: item.instituicao ?? 'Desconhecida',
                    y: item.total
                }))
            }]
        });

        Highcharts.chart('feedbackSatisfacaoChart', {
            chart: { type: 'column' },
            title: { text: 'Feedback por Nível de Satisfação' },
            xAxis: {
                categories: ['1 - Muito Insatisfeito', '2 - Insatisfeito', '3 - Neutro', '4 - Satisfeito', '5 - Muito Satisfeito'],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: { text: 'Quantidade' }
            },
            series: [{
                name: 'Feedbacks',
                data: safeArray(chartData.por_feedback).map(item => item.total)
            }]
        });
    } else {
        console.warn('chartData não definido');
    }
});
