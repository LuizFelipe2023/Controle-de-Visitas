$(document).ready(function () {
    $('input[name="cpf"]').mask('000.000.000-00', { reverse: true });
    $('input[name="rg"]').mask('0000000-0');
    $('input[name="telefone"]').mask('(00) 0000-00009', {
        onKeyPress: function (telefone, e, field, options) {
            let masks = ['(00) 0000-00009', '(00) 00000-0000'];
            let mask = (telefone.length > 14) ? masks[1] : masks[0];
            $('input[name="telefone"]').mask(mask, options);
        }
    });
});