const senha = document.getElementById('senha');
const csenha = document.getElementById('csenha');

function validate(item) {
    item.setCustomValidity('');
    item.checkValidity();

    if (item == csenha) {
        if (item.value === senha.value) item.setCustomValidity('');

        else item.setCustomValidity('Senhas diferentes! Corrija para continuar.');
    }
}


senha.addEventListener('input', function() { validate(senha) });
csenha.addEventListener('input', function() { validate(csenha) });