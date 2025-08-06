@extends('layouts.app')

<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/mascaras/visitasMascara.js') }}"></script>

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-primary rounded-top-4">
                <h4 class="mb-2 mt-2 fw-bold text-white text-center">Editar Visita</h4>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <div class="card-body p-4">
                <form method="POST" action="{{ route('visitas.update', $visita->id) }}" id="visitaForm" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label fw-semibold">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $visita->nome) }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="instituicao" class="form-label fw-semibold">Instituição</label>
                            <input type="text" id="instituicao" name="instituicao" class="form-control @error('instituicao') is-invalid @enderror" value="{{ old('instituicao', $visita->instituicao) }}" required>
                            @error('instituicao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="cpf" class="form-label fw-semibold">CPF</label>
                            <input type="text" id="cpf" name="cpf" class="form-control @error('cpf') is-invalid @enderror" value="{{ old('cpf', $visita->cpf) }}" required>
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="rg" class="form-label fw-semibold">RG</label>
                            <input type="text" id="rg" name="rg" class="form-control @error('rg') is-invalid @enderror" value="{{ old('rg', $visita->rg) }}">
                            @error('rg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label fw-semibold">Telefone</label>
                            <input type="text" id="telefone" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone', $visita->telefone) }}">
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label fw-semibold">Status da Visita</label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="" disabled {{ old('status', $visita->status) ? '' : 'selected' }}>Selecione o status</option>
                                <option value="pendente" {{ (old('status', $visita->status) == 'pendente') ? 'selected' : '' }}>Pendente</option>
                                <option value="aprovada" {{ (old('status', $visita->status) == 'aprovada') ? 'selected' : '' }}>Aprovada</option>
                                <option value="recusada" {{ (old('status', $visita->status) == 'recusada') ? 'selected' : '' }}>Recusada</option>
                                <option value="encerrada" {{ (old('status', $visita->status) == 'encerrada') ? 'selected' : '' }}>Encerrada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="motivo" class="form-label fw-semibold">Motivo da Visita</label>
                            <textarea id="motivo" name="motivo" rows="3" class="form-control @error('motivo') is-invalid @enderror">{{ old('motivo', $visita->motivo) }}</textarea>
                            @error('motivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="foto" class="form-label fw-semibold">Foto (opcional)</label>
                            <input type="file" id="foto" name="foto" class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($visita->foto)
                                <small class="text-muted d-block mt-1">Foto atual: {{ $visita->foto }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('visitas.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle"></i> Voltar
                        </a>
                        <button type="button" class="btn btn-success" id="showConfirmationModal">
                            <i class="bi bi-save"></i> Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="confirmModalLabel">Confirmação dos Dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body" id="modal-body">
                <!-- Conteúdo gerado via JS -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar e Editar</button>
                <button type="button" class="btn btn-success" id="confirmButton">Confirmar Envio</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/modals/visitaModal.js') }}"></script>
@endsection
