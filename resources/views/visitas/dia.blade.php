@extends('layouts.app')
<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>

@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded-3">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h4 class="mb-0 text-dark d-flex align-items-center">
                        <i class="bi bi-calendar-day me-2 fs-4"></i> Visitas do Dia
                        <small class="text-muted ms-2">({{ \Carbon\Carbon::now()->format('d/m/Y') }})</small>
                    </h4>
                    <div class="d-flex gap-2 flex-wrap mt-2 mt-sm-0">
                        <a href="{{ route('visitas.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Voltar para todas as visitas
                        </a>
                        <a href="{{ route('visitas.pdf.relatorio.dia') }}" class="btn btn-secondary">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Gerar PDF do Dia
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                @if($visitasDoDia->count() > 0)
                    <div class="table-responsive">
                        <table id="tabelaVisitas" class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Instituição</th>
                                    <th>Status</th>
                                    <th>Telefone</th>
                                    <th>Motivo</th>
                                    <th style="width: 160px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visitasDoDia as $visita)
                                    <tr>
                                        <td>{{ $visita->nome }}</td>
                                        <td>{{ $visita->cpf }}</td>
                                        <td>{{ $visita->instituicao }}</td>
                                        <td>
                                            <span class="badge 
                                                bg-{{ $visita->status === 'pendente' ? 'warning text-dark' : 
                                                    ($visita->status === 'recusada' ? 'danger' : 'success') }}">
                                                {{ ucfirst($visita->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $visita->telefone }}</td>
                                        <td>{{ Str::limit($visita->motivo, 50) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                                    id="dropdownVisitaDia{{ $visita->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-gear-fill me-1"></i> Ações
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownVisitaDia{{ $visita->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('visitas.edit', $visita->id) }}">
                                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('visitas.pdf.visita', $visita->id) }}" target="_blank">
                                                            <i class="bi bi-file-earmark-pdf me-1"></i> Gerar PDF
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-danger btn-delete" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            data-id="{{ $visita->id }}">
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
                @else
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                        Nenhuma visita registrada para hoje.
                    </div>
                @endif
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
                        <h5 class="modal-title" id="confirmDeleteModalLabel">
                            <i class="bi bi-exclamation-circle me-2 text-danger"></i> Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir esta visita do dia?
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

    <script src="{{ asset('js/tables/diaTable.js') }}"></script>
@endsection
