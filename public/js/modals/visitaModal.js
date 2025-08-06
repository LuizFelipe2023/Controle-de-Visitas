document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#visitaForm');
    const confirmButton = document.getElementById('confirmButton');
    const showConfirmation = document.getElementById('showConfirmationModal');
    const confirmModalEl = document.getElementById('confirmModal');
    const confirmModal = new bootstrap.Modal(confirmModalEl);

    if (!form || !confirmButton || !showConfirmation || !confirmModalEl) {
        console.warn('Algum elemento necessário não foi encontrado.');
        return;
    }

    const fields = ['nome', 'cpf', 'rg', 'instituicao', 'telefone', 'motivo', 'foto', 'status'];

    const fieldLabels = {
        nome: 'Nome',
        cpf: 'CPF',
        rg: 'RG',
        instituicao: 'Instituição',
        telefone: 'Telefone',
        motivo: 'Motivo da Visita',
        foto: 'Foto',
        status: 'Status da Visita', 
    };

    function getValidationMessages() {
        let hasInvalid = false;
        const messages = {};

        ['nome', 'cpf', 'rg', 'instituicao', 'telefone', 'motivo', 'status'].forEach(field => {
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
        if (!el) return '';

        if (fieldName === 'foto') {
            return el.files.length > 0 ? el.files[0] : null;
        }

        if (el.tagName === 'SELECT') {
            return el.options[el.selectedIndex]?.text || '';
        }
        return el.value || '';
    }

    function showModal() {
        const { hasInvalid, messages } = getValidationMessages();

        let modalContent = `<div class="container"><div class="row g-3">`;

        const promises = [];

        fields.forEach(field => {
            const label = fieldLabels[field] || field;
            const value = getValue(field);

            if (field === 'foto') {
                if (value) {
                    promises.push(new Promise(resolve => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            resolve(`
                                <div class="col-12">
                                    <label class="fw-bold">${label}:</label>
                                    <br>
                                    <img src="${e.target.result}" alt="Preview da Foto" style="max-width: 150px; border-radius: 8px; border: 1px solid #ddd;">
                                </div>
                            `);
                        };
                        reader.readAsDataURL(value);
                    }));
                } else {
                    modalContent += `
                        <div class="col-12">
                            <label class="fw-bold">${label}:</label>
                            <p class="text-muted">Nenhuma foto selecionada</p>
                        </div>
                    `;
                }
            } else {
                const error = messages[field] || '';

                modalContent += `
                    <div class="col-12 col-md-6">
                        <label class="fw-bold">${label}:</label>
                        <input type="text" class="form-control" value="${value}" disabled>
                        ${error ? `<div class="invalid-feedback d-block">${error}</div>` : ''}
                    </div>
                `;
            }
        });

        Promise.all(promises).then(results => {
            modalContent += results.join('');
            modalContent += `</div></div>`;
            document.getElementById('modal-body').innerHTML = modalContent;
            confirmButton.style.display = hasInvalid ? 'none' : 'inline-block';
            confirmModal.show();
        });
    }

    showConfirmation.addEventListener('click', showModal);

    confirmButton.addEventListener('click', function () {
        form.submit();
    });
});
