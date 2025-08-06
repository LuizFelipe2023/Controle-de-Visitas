@extends('layouts.app')

@section('content')
<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white rounded-top-3 text-center py-2 border-bottom">
                    <h3 class="fw-bold mb-0">{{ $contato->nome }}</h3>
                    <small>Detalhes do contato</small>
                </div>

                <div class="card-body p-3">

                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <a href="{{ route('contatos.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Voltar
                        </a>
                    </div>

                    <section class="mb-3">
                        <h5 class="fw-semibold border-bottom pb-1 mb-2">Informações</h5>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Nome</label>
                                <div class="form-control-plaintext bg-light rounded p-2 small">{{ $contato->nome ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Telefone</label>
                                <div class="form-control-plaintext bg-light rounded p-2 small">{{ $contato->telefone ?? '-' }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">E-mail</label>
                                <div class="form-control-plaintext bg-light rounded p-2 small">{{ $contato->email ?? '-' }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Assunto</label>
                                <div class="form-control-plaintext bg-light rounded p-2 small">{{ $contato->assunto ?? '-' }}</div>
                            </div>
                        </div>
                    </section>

                    <section class="mb-2">
                        <h5 class="fw-semibold border-bottom pb-1 mb-2">Descrição</h5>
                        <div class="bg-light rounded p-2 small" style="white-space: pre-wrap;">{{ $contato->descricao ?? '-' }}</div>
                    </section>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
