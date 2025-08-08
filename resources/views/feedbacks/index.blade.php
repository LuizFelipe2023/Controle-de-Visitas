@extends('layouts.app')

<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">
                        <i class="bi bi-chat-square-heart-fill me-2"></i> Feedbacks
                    </h4>

                    <div class="d-flex gap-2">
                        <a href="{{ route('feedbacks.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Novo Feedback
                        </a>
                        <a href="{{ route('feedback.relatorio.pdf') }}" class="btn btn-outline-secondary" target="_blank">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Relatório Mensal
                        </a>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="tabelaFeedbacks" class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Nível de Satisfação</th>
                                <th class="text-center" style="width: 160px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->nome }}</td>
                                    <td>{{ $feedback->cpf }}</td>
                                    <td>{{ $feedback->nivel_satisfacao }}/5</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                                id="dropdownFeedback{{ $feedback->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="bi bi-gear-fill me-1"></i> Ações
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item text-danger btn-delete" data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal" data-id="{{ $feedback->id }}">
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

    <!-- Modal de confirmação -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-circle me-2 text-danger"></i> Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir este feedback?
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

    <script src="{{ asset('js/tables/feedbacksTable.js') }}"></script>
@endsection