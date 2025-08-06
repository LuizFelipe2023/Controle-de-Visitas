@extends('layouts.app')
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>
@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-3">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h4 class="mb-0 d-flex align-items-center">
                    <i class="bi bi-people-fill me-2"></i> Visitas
                </h4>
                <div class="d-flex flex-column flex-sm-row gap-2 mt-3 mt-sm-0">
                    <a href="{{ route('visitas.pdf.relatorio') }}" class="btn btn-outline-secondary" target="_blank" rel="noopener">
                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Gerar Relatório PDF
                    </a>
                    <a href="{{ route('visitas.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Nova Visita
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tabelaVisitas" class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Instituição</th>
                            <th>Status</th>
                            <th>Telefone</th>
                            <th>Motivo</th>
                            <th class="text-center" style="width: 140px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitas as $visita)
                            <tr>
                                <td>{{ $visita->nome }}</td>
                                <td>{{ $visita->cpf }}</td>
                                <td>{{ $visita->instituicao }}</td>
                                <td>
                                    <span class="badge
                                        @if($visita->status === 'aprovada') bg-success
                                        @elseif($visita->status === 'pendente') bg-warning text-dark
                                        @elseif($visita->status === 'recusada') bg-danger
                                        @elseif($visita->status === 'encerrada') bg-secondary
                                        @else bg-info
                                        @endif
                                    ">
                                        {{ ucfirst($visita->status) }}
                                    </span>
                                </td>
                                <td>{{ $visita->telefone }}</td>
                                <td class="text-truncate" style="max-width: 200px;">{{ $visita->motivo }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                            id="dropdownVisita{{ $visita->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false" aria-label="Ações da visita {{ $visita->nome }}">
                                            <i class="bi bi-gear-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownVisita{{ $visita->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('visitas.show', $visita->id) }}">
                                                    <i class="bi bi-eye me-2"></i> Visualizar
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('visitas.edit', $visita->id) }}">
                                                    <i class="bi bi-pencil-square me-2"></i> Editar
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('visitas.pdf.visita', $visita->id) }}" target="_blank">
                                                    <i class="bi bi-file-earmark-pdf me-2"></i> Gerar PDF
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button class="dropdown-item text-danger btn-delete" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                    data-id="{{ $visita->id }}">
                                                    <i class="bi bi-trash-fill me-2"></i> Excluir
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

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir esta visita?
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

<script src="{{ asset('js/tables/visitasTable.js') }}"></script>
@endsection
