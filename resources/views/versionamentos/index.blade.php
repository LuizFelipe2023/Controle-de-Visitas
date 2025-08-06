@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <div class="row align-items-center mb-4">
                    <div class="col-12 col-md-8">
                        <h3 class="mb-3 mb-md-0">
                            <i class="bi bi-clock-history me-2"></i> Histórico de Versionamentos
                        </h3>
                    </div>
                    <div class="col-12 col-md-4 text-md-end">
                        <a href="{{ route('versionamentos.create') }}" class="btn btn-primary w-100 w-md-auto">
                            <i class="bi bi-plus-lg me-1"></i> Cadastrar Novo Versionamento
                        </a>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                @if($versionamentos->isEmpty())
                    <p class="text-muted">Nenhum versionamento encontrado.</p>
                @else
                    <div class="row gx-3 gy-3 justify-content-center">
                        @foreach($versionamentos as $versionamento)
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $versionamento->modulo }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            Versão: {{ $versionamento->versao ?? 'N/A' }}
                                        </h6>
                                        <p class="card-text flex-grow-1">
                                            {{ Str::limit($versionamento->descricao, 120) }}
                                        </p>
                                        <p class="mb-1"><small><strong>Criado por:</strong>
                                                {{ $versionamento->usuario->name ?? 'Desconhecido' }}</small></p>
                                        <p><small><strong>Data:</strong>
                                                {{ $versionamento->created_at->format('d/m/Y H:i') }}</small></p>

                                        <div class="mt-3 d-flex justify-content-end">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton{{ $versionamento->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-gear-fill"></i> Ações
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton{{ $versionamento->id }}">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('versionamentos.show', $versionamento->id) }}">
                                                            <i class="bi bi-eye me-2"></i> Detalhes
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('versionamentos.edit', $versionamento->id) }}">
                                                            <i class="bi bi-pencil-square me-2"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item text-danger"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            onclick="setDeleteAction({{ $versionamento->id }})">
                                                            <i class="bi bi-trash-fill me-2"></i> Excluir
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $versionamentos->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir este versionamento?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Excluir
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/delete/deleteVersionamento.js') }}"></script>
@endsection