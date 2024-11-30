<?php
session_start();

// Verificar si el usuario tiene acceso autorizado
if (!isset($_SESSION['new_user_id'])) {
    $_SESSION['error'] = "Acceso no autorizado.";
    header("Location: /index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  	<link rel="icon" type="../image/png" href="img/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CecyFriends</title>
    <!-- Fuentes y Estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=M+PLUS+Rounded+1c:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../img/logo.png" alt="" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Explorar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Contenido -->
    <main class="container mt-5">
        <section class="form-container">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Bienvenido! Necesitamos un poco mas para empezar</h2>
                </div>
                <div class="card-body">
                    <form action="../php/extrainfo.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="grupo">Grupo (Ejemplo: TPROG-AV):</label>
                            <input type="text" class="form-control" id="grupo" name="grupo" placeholder="Ejemplo: TPROG-AV" required>
                        </div>

                        <!-- Talentos -->
                        <h3 class="text-secondary mt-5 mb-4">Talentos</h3>
                        <div class="form-group mb-3">
                            <label for="talentos">Talentos:</label>
                            <input type="text" class="form-control" id="talentos-input" placeholder="Escribe un talento y presiona Enter">
                            <div id="talentos-tags" class="mt-2">
                                <!-- Aquí se mostrarán las etiquetas -->
                            </div>
                            <input type="hidden" id="talentos" name="talentos">
                        </div>

                        <!-- Subida de foto de perfil -->
                        <h3 class="text-secondary mt-5 mb-4">Foto de Perfil</h3>
                        <div class="form-group mb-3">
                            <label for="foto_perfil">Sube tu foto de perfil (JPG o PNG, máx. 2MB):</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/png, image/jpeg" required>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-primary-cta">Registrar</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2024 ConectaProyectos | Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/profile.js"></script>
</body>
</html>
