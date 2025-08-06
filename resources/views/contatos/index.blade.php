@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>

<div class="container mt-4">
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
                <h4 class="mb-0 d-flex align-items-center">
                    <i class="bi bi-envelope-fill me-2"></i> Contatos
                </h4>
                <a href="{{ route('contatos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Novo Contato
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" id="tabelaContatos">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Assunto</th>
                            <th>Descrição</th>
                            <th>Criado em</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contatos as $contato)
                            <tr>
                                <td>{{ $contato->nome }}</td>
                                <td>{{ $contato->telefone }}</td>
                                <td>{{ $contato->email }}</td>
                                <td>{{ $contato->assunto }}</td>
                                <td>{{ Str::limit($contato->descricao, 40) }}</td>
                                <td>{{ $contato->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                            id="dropdownContato{{ $contato->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="bi bi-gear-fill me-1"></i> Ações
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownContato{{ $contato->id }}">
                                            <li>
                                                <button class="dropdown-item text-danger btn-delete" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                    data-id="{{ $contato->id }}">
                                                    <i class="bi bi-trash-fill me-1"></i> Excluir
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">
                        <i class="bi bi-exclamation-circle me-2 text-danger"></i> Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este contato?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash-fill me-1"></i> Excluir
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/tables/contatosTable.js') }}"></script>
@endsection
