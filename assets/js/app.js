console.log('Proyecto MVC escolar cargado');

document.addEventListener('DOMContentLoaded', function () {
    var pwd1 = document.getElementById('pwd1');
    var pwd2 = document.getElementById('pwd2');
    var mensaje = document.getElementById('mensaje-password');
    var boton = document.getElementById('btn-check-pwd');
    var toggle = document.getElementById('toggle-change-password');
    var currentPwd = document.getElementById('current-pwd');

    if (!pwd1 || !pwd2 || !mensaje || !boton) {
        return;
    }

    function validarPasswords() {
        var valor1 = pwd1.value;
        var valor2 = pwd2.value;
        var limpio1 = valor1.trim();
        var limpio2 = valor2.trim();
        var esEdicion = !!toggle;

        if (esEdicion && !toggle.checked) {
            mensaje.textContent = '';
            boton.disabled = false;
            return;
        }

        if (esEdicion && currentPwd && currentPwd.value.trim() === '') {
            mensaje.textContent = 'Debes escribir la contraseña actual.';
            boton.disabled = true;
            return;
        }

        if (limpio1.length < 3 || limpio2.length < 3) {
            mensaje.textContent = 'La contraseña debe tener minimo 3 digitos y no debe estar vacia.';
            boton.disabled = true;
            return;
        }

        if (valor1 !== valor2) {
            mensaje.textContent = 'Las contraseñas no coinciden.';
            boton.disabled = true;
            return;
        }

        mensaje.textContent = '';
        boton.disabled = false;
    }

    function actualizarEstadoCambioPassword() {
        if (!toggle) {
            validarPasswords();
            return;
        }

        var habilitar = toggle.checked;

        if (currentPwd) {
            currentPwd.disabled = !habilitar;
        }

        pwd1.disabled = !habilitar;
        pwd2.disabled = !habilitar;

        if (!habilitar) {
            if (currentPwd) {
                currentPwd.value = '';
            }
            pwd1.value = '';
            pwd2.value = '';
        }

        validarPasswords();
    }

    pwd1.addEventListener('input', validarPasswords);
    pwd2.addEventListener('input', validarPasswords);

    if (currentPwd) {
        currentPwd.addEventListener('input', validarPasswords);
    }

    if (toggle) {
        toggle.addEventListener('change', actualizarEstadoCambioPassword);
        actualizarEstadoCambioPassword();
        return;
    }

    validarPasswords();
});
