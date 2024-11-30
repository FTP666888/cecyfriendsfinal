// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    die("Acceso no autorizado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="../image/png" href="img/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos - CecyFriends</title>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=M+PLUS+Rounded+1c:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../img/logo.png" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/profile">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/search/crear.php">Crear Proyecto</a></li>
                    <li class="nav-item"><a class="nav-link" href="/search/interesados.php">Ver Interesados</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main class="container mt-5">
        <section id="tinder-section"></section>
    </main>

    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2024 CecyFriends | Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/tinder.js"></script>

</body>
</html>
