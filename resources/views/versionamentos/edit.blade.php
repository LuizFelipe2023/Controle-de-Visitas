@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-dark rounded-top-4">
                <h4 class="mb-2 mt-2 fw-bold text-white text-center">Editar Versionamento</h4>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('versionamentos.update', $versionamento->id) }}" id="versionamentoForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="modulo" class="form-label fw-semibold">Módulo</label>
                        <input type="text" name="modulo" id="modulo"
                               class="form-control @error('modulo') is-invalid @enderror"
                               placeholder="Digite o módulo"
                               value="{{ old('modulo', $versionamento->modulo) }}" required>
                        @error('modulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-semibold">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="4"
                                  class="form-control @error('descricao') is-invalid @enderror"
                                  placeholder="Descreva o versionamento" required>{{ old('descricao', $versionamento->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="versao" class="form-label fw-semibold">Versão</label>
                        <input type="text" name="versao" id="versao"
                               class="form-control @error('versao') is-invalid @enderror"
                               placeholder="Digite a versão"
                               value="{{ old('versao', $versionamento->versao) }}" required>
                        @error('versao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('versionamentos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="button" class="btn btn-primary" id="showConfirmationModal">Salvar Alterações</button>
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
                <!-- Dados serão inseridos dinamicamente aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar e Editar</button>
                <button type="button" class="btn btn-success" id="confirmButton">Confirmar Envio</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/modals/versionamentoModal.js') }}"></script>
@endsection
