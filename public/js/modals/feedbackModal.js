document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#feedbackForm');
    const confirmButton = document.getElementById('confirmButton');
    const showConfirmation = document.getElementById('showConfirmationModal');
    const confirmModalEl = document.getElementById('confirmModal');
    const confirmModal = new bootstrap.Modal(confirmModalEl);

    if (!form || !confirmButton || !showConfirmation || !confirmModalEl) {
        console.warn('Algum elemento necessário não foi encontrado.');
        return;
    }

    const fields = ['nome', 'cpf', 'nivel_satisfacao'];

    const fieldLabels = {
        nome: 'Nome',
        cpf: 'CPF',
        nivel_satisfacao: 'Nível de Satisfação'
    };

    function getValidationMessages() {
        let hasInvalid = false;
        const messages = {};

        fields.forEach(field => {
            const el = form.querySelector(`[name="${field}"]`);
            const value = el?.value?.trim() || '';
            if (value === '') {
                hasInvalid = true;
                messages[field] = 'Campo obrigatório';
            }
        });

        return { hasInvalid, messages };
    }

    function renderEstrelas(valor) {
        let html = `<div class="d-flex justify-content-start gap-1 fs-3 text-warning">`;
        for (let i = 1; i <= 5; i++) {
            html += `<span>${i <= valor ? '★' : '☆'}</span>`;
        }
        html += `</div>`;
        return html;
    }

    function getValue(fieldName) {
        const el = form.querySelector(`[name="${fieldName}"]`);
        return el?.value || '';
    }

    function showModal() {
        const { hasInvalid, messages } = getValidationMessages();

        let modalContent = `<div class="container"><div class="row g-3">`;

        fields.forEach(field => {
            const label = fieldLabels[field] || field;
            let value = getValue(field);

            modalContent += `<div class="col-12 col-md-6">
                    <label class="fw-bold">${label}:</label>`;

            if (field === 'nivel_satisfacao') {
                modalContent += renderEstrelas(parseInt(value));
            } else {
                modalContent += `<input type="text" class="form-control" value="${value}" disabled>`;
            }

            if (messages[field]) {
                modalContent += `<div class="invalid-feedback d-block">${messages[field]}</div>`;
            }

            modalContent += `</div>`;
        });

        modalContent += `</div></div>`;
        document.getElementById('modal-body').innerHTML = modalContent;

        confirmButton.style.display = hasInvalid ? 'none' : 'inline-block';
        confirmModal.show();
    }

    showConfirmation.addEventListener('click', showModal);
    confirmButton.addEventListener('click', function () {
        form.submit();
    });
});
