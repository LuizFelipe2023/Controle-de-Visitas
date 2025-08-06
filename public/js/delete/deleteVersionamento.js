document.addEventListener('DOMContentLoaded', function () {
    const deleteForm = document.getElementById('deleteForm');
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const versionamentoId = this.getAttribute('data-id');
            deleteForm.action = `/versionamentos/${versionamentoId}/delete`;
        });
    });
});
