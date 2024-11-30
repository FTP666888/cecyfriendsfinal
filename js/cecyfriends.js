document.getElementById('toggle-btn').addEventListener('click', function () {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const formTitle = document.querySelector('.hero-title'); // Título principal
    const formSubtitle = document.querySelector('.hero-subtitle'); // Subtítulo
    const toggleText = document.getElementById('toggle-text'); // Texto dinámico del botón
    const toggleBtn = document.getElementById('toggle-btn'); // Botón completo

    // Determinar si estamos en el login o en el registro
    const isLoginVisible = loginForm.style.display !== 'none';

    // Alternar visibilidad de los formularios
    loginForm.style.display = isLoginVisible ? 'none' : 'block';
    registerForm.style.display = isLoginVisible ? 'block' : 'none';

    // Actualizar textos según el formulario activo
    if (isLoginVisible) {
        formTitle.textContent = 'Regístrate';
        formSubtitle.textContent = 'Nuevo por aquí? ¡Regístrate!';
        toggleText.textContent = 'Inicia Sesión';
        toggleBtn.textContent = '¿Ya tienes cuenta? ';
        toggleBtn.appendChild(toggleText); // Asegurarse de que el span siga visible
    } else {
        formTitle.textContent = 'Inicia Sesión';
        formSubtitle.textContent = 'Bienvenido, accede';
        toggleText.textContent = 'Regístrate';
        toggleBtn.textContent = '¿No tienes una cuenta? ';
        toggleBtn.appendChild(toggleText); // Asegurarse de que el span siga visible
    }
});

// Validación del formulario de registro
document.getElementById('register-form').addEventListener('submit', function (event) {
    const emailInput = document.getElementById('register-email');
    const emailValue = emailInput.value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@cecyteq\.edu\.mx$/;

    if (!emailPattern.test(emailValue)) {
        event.preventDefault(); // Detener el envío del formulario
        alert("Por favor, ingresa un correo institucional válido que termine en @cecyteq.edu.mx.");
        emailInput.focus(); // Enfocar el campo del correo electrónico
    }
});

document.addEventListener("DOMContentLoaded", () => {
    fetch('php/utils/get-messages.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                const errorDiv = document.getElementById("error-message");
                errorDiv.textContent = data.error;
                errorDiv.classList.remove("d-none");
            }

            if (data.success) {
                const successDiv = document.getElementById("success-message");
                successDiv.textContent = data.success;
                successDiv.classList.remove("d-none");
            }
        })
        .catch(err => console.error('Error cargando mensajes:', err));
});

