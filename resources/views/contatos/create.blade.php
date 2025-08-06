@extends('layouts.guest')
@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header rounded-top-3 text-center py-2"
                    style="background: linear-gradient(135deg, #4c1d95, #6d28d9);">
                    <h4 class="mb-2 mt-2 fw-bold text-white text-center">Cadastrar Novo Contato</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('contatos.store') }}" id="contatoForm">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome</label>
                            <input type="text" name="nome" id="nome"
                                class="form-control @error('nome') is-invalid @enderror" placeholder="Digite o nome"
                                value="{{ old('nome') }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label fw-semibold">Telefone</label>
                            <input type="text" name="telefone" id="telefone"
                                class="form-control @error('telefone') is-invalid @enderror" placeholder="Digite o telefone"
                                value="{{ old('telefone') }}" required>
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Digite o email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="assunto" class="form-label fw-semibold">Assunto</label>
                            <input type="text" name="assunto" id="assunto"
                                class="form-control @error('assunto') is-invalid @enderror" placeholder="Digite o assunto"
                                value="{{ old('assunto') }}" required>
                            @error('assunto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label fw-semibold">Descrição</label>
                            <textarea name="descricao" id="descricao" rows="4"
                                class="form-control @error('descricao') is-invalid @enderror"
                                placeholder="Descreva o contato" required>{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('login') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="button" class="btn btn-primary" id="showConfirmationModal">Cadastrar</button>
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

    <script src="{{ asset('js/modals/contatoModal.js') }}"></script>
@endsection