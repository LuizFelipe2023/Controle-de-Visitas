@extends('layouts.app')
@section('title', 'Painel de Visitas')

{{-- Highcharts --}}
<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('js/highcharts/exporting.js') }}"></script>
<script src="{{ asset('js/highcharts/export-data.js') }}"></script>
<script src="{{ asset('js/highcharts/offline-exporting.js') }}"></script>
<script src="{{ asset('js/highcharts/accessibility.js') }}"></script>

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-dark text-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div class="mb-2 mb-md-0">
                        <h2 class="mb-1"><i class="bi bi-speedometer2 me-2"></i>Painel de Visitas - Visão Geral</h2>
                        <p class="mb-0 text-white-50">Estatísticas completas das visitas e feedbacks</p>
                    </div>
                    <span class="badge bg-white text-primary fw-semibold">
                        <i class="bi bi-calendar3 me-2"></i>{{ now()->format('d/m/Y') }}
                    </span>
                </div>

                <div class="card-body bg-light">
                    <div class="row g-4 mb-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-people-fill fs-2 text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted text-uppercase mb-1 fw-bold">Total de Visitas</h6>
                                        <h3 class="fw-bold mb-0">{{ $chartData['total'] }}</h3>
                                        <small class="text-success"><i class="bi bi-arrow-up"></i> Últimos 30 dias</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-chat-square-text-fill fs-2 text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted text-uppercase mb-1 fw-bold">Feedbacks Recebidos</h6>
                                        <h3 class="fw-bold mb-0">{{ $chartData['totalFeedbacks'] ?? 0 }}</h3>
                                        <small class="text-primary"><i class="bi bi-arrow-up-right"></i> Taxa de resposta</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-lg-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-white">
                                    <h5 class="fw-bold text-primary mb-0">
                                        <i class="bi bi-calendar-week me-2"></i>Visitas por Dia
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="visitasPorDiaChart" style="height: 300px;"></div>
                                </div>
                                <div class="card-footer bg-light">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>Últimos 15 dias
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-white">
                                    <h5 class="fw-bold text-primary mb-0">
                                        <i class="bi bi-building me-2"></i>Visitas por Instituição
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="visitasPorInstituicaoChart" style="height: 300px;"></div>
                                </div>
                                <div class="card-footer bg-light">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>Top 5 instituições
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-white">
                                    <h5 class="fw-bold text-primary mb-0">
                                        <i class="bi bi-star-fill me-2"></i>Nível de Satisfação
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="feedbackSatisfacaoChart" style="height: 300px;"></div>
                                </div>
                                <div class="card-footer bg-light">
                                    <div class="row text-muted small">
                                        <div class="col-md-4">
                                            <i class="bi bi-check-circle-fill text-success me-1"></i>Média: 4.2/5
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <i class="bi bi-people-fill text-primary me-1"></i>Total: {{ $chartData['totalFeedbacks'] ?? 0 }} respostas
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <i class="bi bi-calendar-range me-1"></i>Período: 30 dias
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-clock-history me-1"></i>Atualizado em {{ now()->format('d/m/Y H:i') }}
                    </small>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-download me-1"></i>Exportar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const chartData = @json($chartData);
</script>
<script src="{{ asset('js/graficos/painel.js') }}"></script>
@endsection
