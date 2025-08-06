@extends('layouts.app')

<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/mascaras/visitasMascara.js') }}"></script>

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-dark rounded-top-4">
                <h4 class="mb-2 mt-2 fw-bold text-white text-center">Cadastrar Nova Visita</h4>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card-body p-4">
                <form method="POST" action="{{ route('visitas.store') }}" enctype="multipart/form-data" id="visitaForm">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nome</label>
                            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                                placeholder="Digite o nome da visita" value="{{ old('nome') }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Instituição</label>
                            <input type="text" name="instituicao"
                                class="form-control @error('instituicao') is-invalid @enderror"
                                placeholder="Digite a instituição" value="{{ old('instituicao') }}">
                            @error('instituicao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CPF</label>
                            <input type="text" name="cpf" class="form-control @error('cpf') is-invalid @enderror"
                                placeholder="Digite o CPF" value="{{ old('cpf') }}" required>
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">RG</label>
                            <input type="text" name="rg" class="form-control @error('rg') is-invalid @enderror"
                                placeholder="Digite o RG" value="{{ old('rg') }}">
                            @error('rg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Telefone</label>
                            <input type="text" name="telefone"
                                class="form-control @error('telefone') is-invalid @enderror"
                                placeholder="Digite o telefone" value="{{ old('telefone') }}">
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status da Visita</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="">Selecione o status</option>
                                <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="aprovada" {{ old('status') == 'aprovada' ? 'selected' : '' }}>Aprovada</option>
                                <option value="recusada" {{ old('status') == 'recusada' ? 'selected' : '' }}>Recusada</option>
                                <option value="encerrada" {{ old('status') == 'encerrada' ? 'selected' : '' }}>Encerrada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Motivo da Visita</label>
                            <textarea name="motivo" class="form-control @error('motivo') is-invalid @enderror"
                                placeholder="Descreva o motivo da visita" rows="3">{{ old('motivo') }}</textarea>
                            @error('motivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Foto</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('visitas.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle"></i> Voltar
                        </a>
                        <button type="button" class="btn btn-success" id="showConfirmationModal">
                            <i class="bi bi-save"></i> Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="confirmModalLabel">Confirmação dos Dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body" id="modal-body">
                <!-- Dados são inseridos aqui dinamicamente -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Voltar e Editar</button>
                <button type="button" class="btn btn-md btn-success" id="confirmButton">Confirmar Envio</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/modals/visitaModal.js') }}"></script>
@endsection
