@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white text-center rounded-top-3 py-3">
                    <h4 class="fw-bold mb-0">{{ $versionamento->modulo }}</h4>
                    <small>Detalhes do Versionamento</small>
                </div>

                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                        <a href="{{ route('versionamentos.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left-circle me-1"></i> Voltar
                        </a>
                        <a href="{{ route('versionamentos.edit', $versionamento->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        </a>
                    </div>

                    <section class="mb-4">
                        <h5 class="fw-semibold border-bottom pb-2">Informações Gerais</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Módulo</label>
                                <div class="border rounded px-3 py-2 bg-light small">{{ $versionamento->modulo ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Versão</label>
                                <div class="border rounded px-3 py-2 bg-light small">{{ $versionamento->versao ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Criado por</label>
                                <div class="border rounded px-3 py-2 bg-light small">{{ $versionamento->usuario->name ?? 'Desconhecido' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Data de Criação</label>
                                <div class="border rounded px-3 py-2 bg-light small">
                                    {{ $versionamento->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h5 class="fw-semibold border-bottom pb-2">Descrição</h5>
                        <div class="border rounded bg-light p-3 small" style="white-space: pre-wrap;">
                            {{ $versionamento->descricao ?? '-' }}
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
