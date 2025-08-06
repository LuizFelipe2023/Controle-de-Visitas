document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#versionamentoForm');
    const confirmButton = document.getElementById('confirmButton');
    const showConfirmation = document.getElementById('showConfirmationModal');
    const confirmModalEl = document.getElementById('confirmModal');
    const confirmModal = new bootstrap.Modal(confirmModalEl);

    if (!form || !confirmButton || !showConfirmation || !confirmModalEl) {
        console.warn('Algum elemento necessário não foi encontrado.');
        return;
    }

    const fields = ['modulo', 'descricao', 'versao'];

    const fieldLabels = {
        modulo: 'Módulo',
        descricao: 'Descrição',
        versao: 'Versão'
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

            if (field === 'descricao') {
                value = value.replace(/\n/g, '<br>');
                modalContent += `
                    <div class="col-12">
                        <label class="fw-bold">${label}:</label>
                        <div class="border rounded p-2" style="background-color: #f8f9fa;">${value}</div>
                        ${messages[field] ? `<div class="invalid-feedback d-block">${messages[field]}</div>` : ''}
                    </div>
                `;
            } else {
                modalContent += `
                    <div class="col-12 col-md-6">
                        <label class="fw-bold">${label}:</label>
                        <input type="text" class="form-control" value="${value}" disabled>
                        ${messages[field] ? `<div class="invalid-feedback d-block">${messages[field]}</div>` : ''}
                    </div>
                `;
            }
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
