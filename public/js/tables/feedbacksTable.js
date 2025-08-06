$(document).ready(function() {
    $('#tabelaFeedbacks').DataTable({
        responsive: true,
        columnDefs: [
            { orderable: false, targets: 3 } 
        ],
        language: {
            decimal:        "",
            emptyTable:     "Nenhum dado disponível na tabela",
            info:           "Mostrando _START_ até _END_ de _TOTAL_ registros",
            infoEmpty:      "Mostrando 0 até 0 de 0 registros",
            infoFiltered:   "(filtrado de _MAX_ registros no total)",
            infoPostFix:    "",
            thousands:      ",",
            lengthMenu:     "Mostrar _MENU_ registros por página",
            loadingRecords: "Carregando...",
            processing:     "Processando...",
            search:         "Pesquisar:",
            zeroRecords:    "Nenhum registro encontrado",
            paginate: {
                first:      "Primeiro",
                last:       "Último",
                next:       "Próximo",
                previous:   "Anterior"
            },
            aria: {
                sortAscending:  ": ativar para ordenar a coluna de forma ascendente",
                sortDescending: ": ativar para ordenar a coluna de forma descendente"
            }
        }
    });
});

let confirmDeleteModal = document.getElementById('confirmDeleteModal');
if (confirmDeleteModal) {
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const feedbackId = button.getAttribute('data-id');
        const form = confirmDeleteModal.querySelector('#deleteForm');
        form.action = "/feedbacks/" + feedbackId;
    });
}
