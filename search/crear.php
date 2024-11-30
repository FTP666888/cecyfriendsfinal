<?php
session_start();
require '../php/utils/conection.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    die("Acceso no autorizado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="../image/png" href="../img/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto - CecyFriends</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/profile.js" defer></script>

</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../img/logo.png" alt="Logo" class="logo">
            </a>
        </div>
    </header>

    <!-- Contenido -->
    <main class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Crear un Nuevo Proyecto</h2>
            </div>
            <div class="card-body">
                <form id="crear-proyecto-form" action="../php/actions/crearproyecto.php" method="POST">
                    <!-- Título -->
                    <div class="form-group mb-3">
                        <label for="titulo">Título del Proyecto:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ejemplo: Taller de Robótica" required>
                    </div>

                    <!-- Talentos Requeridos -->
                    <div class="form-group mb-3">
                        <label for="talentos-requeridos">Talentos Requeridos:</label>
                        <input type="text" class="form-control" id="talentos-input" placeholder="Escribe un talento y presiona Enter">
                        <div id="talentos-tags" class="mt-2">
                            <!-- Aquí se mostrarán las etiquetas -->
                        </div>
                        <input type="hidden" id="talentos" name="talentos_requeridos">
                    </div>

                    <!-- Descripción -->
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción del Proyecto:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion_proyecto" rows="4" placeholder="Ejemplo: Proyecto para construir un robot funcional..." required></textarea>
                    </div>

                    <!-- Recompensas -->
                    <div class="form-group mb-3">
                        <label for="recompensas">Recompensas:</label>
                        <textarea class="form-control" id="recompensas" name="recompensas" rows="3" placeholder="Ejemplo: Certificados, Medallas, Trofeos..." required></textarea>
                    </div>

                    <!-- Fecha de Entrega -->
                    <div class="form-group mb-3">
                        <label for="fecha-entrega">Fecha de Entrega:</label>
                        <input type="date" class="form-control" id="fecha-entrega" name="fecha_entrega" required>
                    </div>

                    <!-- Botón de envío -->
                    <button type="submit" class="btn btn-primary-cta">Crear Proyecto</button>
                </form>
            </div>
        </div>
        <div id="mensaje-resultado" class="mt-4"></div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2024 CecyFriends | Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
