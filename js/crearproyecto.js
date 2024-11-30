document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("crear-proyecto-form");
    const mensajeResultado = document.getElementById("mensaje-resultado");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("../php/crearProyecto.php", {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            mensajeResultado.innerHTML = `
                <div class="alert ${data.success ? 'alert-success' : 'alert-danger'}" role="alert">
                    ${data.message}
                </div>
            `;
            if (data.success) {
                form.reset();
                document.getElementById("talentos-tags").innerHTML = "";
            }
        })
        .catch((error) => {
            mensajeResultado.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    Error al procesar la solicitud.
                </div>
            `;
            console.error("Error:", error);
        });
    });
});
