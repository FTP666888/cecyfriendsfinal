document.addEventListener("DOMContentLoaded", () => {
    const tinderSection = document.getElementById("tinder-section");

    // Función para cargar el primer proyecto o el siguiente
    function loadNextProject() {
        fetch("/php/actions/swipe.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log("Respuesta recibida:", data); // Depuración
                if (data.success) {
                    renderNewCard(data.project); // Renderiza el nuevo proyecto
                } else {
                    showNoProjectsMessage(data.message || "No hay más proyectos disponibles.");
                }
            })
            .catch(error => {
                console.error("Error al cargar el proyecto:", error);
                showNoProjectsMessage("Error al cargar el proyecto. Inténtalo más tarde.");
            });
    }

    // Función para renderizar una nueva tarjeta
    function renderNewCard(project) {
        if (!project || !project.id_grupo) {
            showNoProjectsMessage("Proyecto inválido recibido.");
            return;
        }

        const newCard = `
            <div class="card swipe-card" data-id="${project.id_grupo}">
                <div class="card-header text-center">
                    <h3>${project.titulo || "Título no disponible"}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Talentos Requeridos:</strong> ${project.talentos_requeridos || "No especificados"}</p>
                    <p><strong>Descripción:</strong> ${project.descripcion_proyecto || "No disponible"}</p>
                    <p><strong>Recompensas:</strong> ${project.recompensas || "No especificadas"}</p>
                    <p><strong>Fecha de Entrega:</strong> ${project.fecha_entrega || "No definida"}</p>
                    <hr>
                    <h4>Propietario del Proyecto</h4>
                    <div class="owner-info d-flex align-items-center">
                        <img src="${project.owner_foto || '/profile/pfp/default.png'}" 
                             alt="Foto de perfil" class="rounded-circle me-3" 
                             style="width: 50px; height: 50px;">
                        <div>
                            <p><strong>Nombre:</strong> ${project.owner_nombre || "No disponible"}</p>
                            <p><strong>Grupo:</strong> ${project.owner_grupo || "No especificado"}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <button class="btn-swipe dislike btn btn-danger" data-action="dislike">❌ Rechazar</button>
                    <button class="btn-swipe like btn btn-success" data-action="like">💖 Me interesa</button>
                </div>
            </div>
        `;
        tinderSection.innerHTML = newCard;

        // Reasigna eventos a los nuevos botones
        assignButtonEvents();
    }

    // Función para mostrar mensaje cuando no hay más proyectos
    function showNoProjectsMessage(message) {
        tinderSection.innerHTML = `<p class="text-center">${message}</p>`;
    }

    // Función para manejar las acciones (like/dislike)
    function handleSwipe(action, projectId) {
        fetch("/php/actions/match.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ action, projectId }),
        })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta de match.php:", data); // Depuración
                if (data.success) {
                    loadNextProject(); // Cargar el siguiente proyecto tras la acción
                } else {
                    console.error("Error en la acción:", data.message);
                }
            })
            .catch(error => console.error("Error en la acción:", error));
    }

    // Función para asignar eventos a los botones
    function assignButtonEvents() {
        const buttons = document.querySelectorAll(".btn-swipe");
        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const card = button.closest(".swipe-card");
                if (!card) {
                    console.error("No se encontró la tarjeta activa.");
                    return;
                }
                const projectId = card.getAttribute("data-id");
                const action = button.getAttribute("data-action");
                handleSwipe(action, projectId);
            });
        });
    }

    // Cargar el primer proyecto al cargar la página
    loadNextProject();
});
