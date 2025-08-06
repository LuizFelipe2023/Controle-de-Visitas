@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow rounded-4">
                <div class="card-header bg-primary rounded-top-4 text-center py-3">
                    <h3 class="fw-bold text-white mb-1">{{ $visita->nome }}</h3>
                    <small class="text-white-50 fst-italic">Detalhes da visita</small>
                </div>

                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        @if($visita->foto)
                            <img src="{{ asset('storage/' . $visita->foto) }}" alt="Foto da Visita"
                                class="img-fluid rounded shadow-sm" style="max-height: 220px; object-fit: contain;">
                        @else
                            <p class="text-muted fst-italic small">Sem foto cadastrada</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
                        <a href="{{ route('visitas.pdf.visita', $visita->id) }}" target="_blank" class="btn btn-sm btn-primary d-flex align-items-center">
                            <i class="bi bi-file-earmark-pdf me-2"></i> Gerar PDF
                        </a>
                        <a href="{{ route('visitas.index') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left-circle me-2"></i> Voltar
                        </a>
                    </div>

                    <section class="mb-4">
                        <h5 class="fw-semibold border-bottom pb-2 mb-3">Informações</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Instituição</label>
                                <div class="bg-light border rounded-3 p-3">{{ $visita->instituicao ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">CPF</label>
                                <div class="bg-light border rounded-3 p-3">{{ $visita->cpf ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">RG</label>
                                <div class="bg-light border rounded-3 p-3">{{ $visita->rg ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Telefone</label>
                                <div class="bg-light border rounded-3 p-3">{{ $visita->telefone ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Status</label>
                                <div class="bg-light border rounded-3 p-3">
                                    @php
                                        $statusLabels = [
                                            'pendente' => 'Pendente',
                                            'aprovada' => 'Aprovada',
                                            'recusada' => 'Recusada',
                                            'encerrada' => 'Encerrada',
                                        ];
                                    @endphp
                                    {{ $statusLabels[$visita->status] ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h5 class="fw-semibold border-bottom pb-2 mb-3">Motivo</h5>
                        <div class="bg-light border rounded-3 p-3" style="white-space: pre-wrap;">{{ $visita->motivo ?? '-' }}</div>
                    </section>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
