<?php
session_start();
require '../php/utils/conection.php';

// Verificar si el usuario está logueado (para mostrar el perfil propio por defecto)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Acceso no autorizado.";
    header("Location: /index.php");
    exit();
}

// Conexión a la base de datos
$conn = connection();
if (!$conn) {
    die("Error al conectar con la base de datos.");
}

// Determinar el ID del usuario a mostrar
$id_usuario = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['user_id'];

// Consultar la información del perfil del usuario
$stmt = $conn->prepare("
    SELECT 
        u.nombre, u.email, u.num_tel, u.matricula,
        p.grupo, p.descripcion, p.pfp_path, p.talentos
    FROM usuario u
    LEFT JOIN perfil p ON u.id_usuario = p.id_usuario
    WHERE u.id_usuario = ?
");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Usuario no encontrado.");
}

$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="../image/png" href="img/icon.png">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo htmlspecialchars($user['nombre']); ?> - CecyFriends</title>
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
                <img src="../img/logo.png" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/search/index.php">proyectos</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Perfil de <?php echo htmlspecialchars($user['nombre']); ?></h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Foto de perfil -->
                    <div class="col-md-4 text-center">
                        <img src="<?php echo htmlspecialchars('/profile/pfp/' . basename($user['pfp_path'])); ?>" alt="Foto de perfil" class="img-fluid rounded-circle" style="max-width: 200px;">
                    </div>
                    <!-- Información del usuario -->
                    <div class="col-md-8">
                        <h3 class="mb-3"><?php echo htmlspecialchars($user['nombre']); ?></h3>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($user['num_tel']); ?></p>
                        <p><strong>Matrícula:</strong> <?php echo htmlspecialchars($user['matricula']); ?></p>
                        <p><strong>Grupo:</strong> <?php echo htmlspecialchars($user['grupo']); ?></p>
                        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($user['descripcion']); ?></p>
                    </div>
                </div>
                <!-- Talentos -->
                <div class="mt-4">
                    <h4>Talentos</h4>
                    <div id="talentos-tags">
                        <?php
                        $talentos = explode(',', $user['talentos']);
                        foreach ($talentos as $talento) {
                            if (trim($talento) !== '') {
                                echo '<span class="tag">#' . htmlspecialchars(trim($talento)) . '</span>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2024 CecyFriends | Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
