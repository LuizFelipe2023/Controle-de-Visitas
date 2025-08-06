@extends('layouts.guest')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/mascaras/feedbackMascara.js') }}"></script>
<script src="{{ asset('js/modals/feedbackModal.js') }}"></script>

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg animate__animated animate__fadeIn">
                <div class="card-header bg-primary text-white py-4 rounded-top">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-chat-square-text-fill display-5 me-3"></i>
                        <div>
                            <h2 class="mb-0 fw-bold">Pesquisa de Satisfação</h2>
                            <p class="mb-0 text-white-50">Sua opinião é muito importante para nós!</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="progress mb-4" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>

                    <form method="POST" action="{{ route('feedbacks.store') }}" id="feedbackForm">
                        @csrf

                        {{-- Dados Pessoais --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-person-badge me-2"></i> Dados Pessoais
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="nome" class="form-label fw-semibold">Nome Completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-person-fill text-muted"></i></span>
                                        <input type="text" name="nome" id="nome"
                                            class="form-control @error('nome') is-invalid @enderror"
                                            value="{{ old('nome') }}" placeholder="Digite seu nome completo" required>
                                        @error('nome')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="cpf" class="form-label fw-semibold">CPF</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-credit-card-fill text-muted"></i></span>
                                        <input type="text" name="cpf" id="cpf"
                                            class="form-control @error('cpf') is-invalid @enderror"
                                            value="{{ old('cpf') }}" placeholder="000.000.000-00" required>
                                        @error('cpf')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 pt-2">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-star-fill me-2"></i> Avalie sua experiência
                            </h5>

                            <div class="p-4 bg-light rounded">
                                <p class="text-muted mb-3">Como você avalia sua visita em relação aos seguintes aspectos?</p>
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input d-none" type="radio" name="nivel_satisfacao" id="star{{ $i }}" value="{{ $i }}"
                                                {{ old('nivel_satisfacao') == $i ? 'checked' : '' }} required>
                                            <label for="star{{ $i }}" title="{{ $i }} estrelas" style="font-size: 2rem; cursor: pointer;" class="text-warning">&#9733;</label>
                                        </div>
                                    @endfor
                                </div>
                                <div class="d-flex justify-content-between mt-2 px-1">
                                    <small class="text-muted">Péssimo</small>
                                    <small class="text-muted">Excelente</small>
                                </div>
                                @error('nivel_satisfacao')
                                    <div class="text-danger mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if (isset($visita))
                            <input type="hidden" name="visita_id" value="{{ $visita->id }}">
                        @endif

                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <button type="button" class="btn btn-primary px-4 py-2" id="showConfirmationModal">
                                <i class="bi bi-send-check me-2 text-white"></i> Enviar Avaliação
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4 text-muted">
                <p class="small">
                    <i class="bi bi-lock-fill me-1"></i> Seus dados estão seguros conosco.
                    <a href="#" class="text-decoration-none">Política de Privacidade</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="confirmModalLabel">
                    <i class="bi bi-check-circle-fill me-2"></i> Confirmação
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body p-4" id="modal-body"></div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-pencil-fill me-1"></i> Editar
                </button>
                <button type="button" class="btn btn-success" id="confirmButton">
                    <i class="bi bi-check-lg me-1"></i> Confirmar Envio
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
