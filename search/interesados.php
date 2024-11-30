<?php
session_start();
require '../php/utils/conection.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    die("Acceso no autorizado.");
}

$conn = connection();
$id_usuario = $_SESSION['user_id'];

// Consulta para obtener los proyectos del propietario y sus interesados
$stmt = $conn->prepare("
    SELECT 
        g.titulo AS proyecto, 
        u.nombre AS interesado, 
        u.id_usuario AS id_interesado, 
        ug.fecha_interes, 
        ug.match_confirmado,
        ug.id_match
    FROM 
        usuario_grupo ug
    JOIN 
        grupo g ON ug.id_grupo = g.id_grupo
    JOIN 
        usuario u ON ug.id_interesado = u.id_usuario
    WHERE 
        g.id_owner = ?
    ORDER BY 
        ug.fecha_interes DESC
");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$interesados = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="../image/png" href="img/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interesados - CecyFriends</title>
    <!-- Fuentes y Estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/handleinterest.js" defer></script>
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
                <h2>Usuarios Interesados en Tus Proyectos</h2>
            </div>
            <div class="card-body">
                <?php if (count($interesados) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Proyecto</th>
                                <th>Interesado</th>
                                <th>Fecha de Interés</th>
                                <th>Confirmado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($interesados as $interesado): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($interesado['proyecto']); ?></td>
                                    <td>
                                        <a href="https://cecyfriends.com/profile/index.php?id=<?php echo $interesado['id_interesado']; ?>">
                                            <?php echo htmlspecialchars($interesado['interesado']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($interesado['fecha_interes']); ?></td>
                                    <td><?php echo $interesado['match_confirmado'] ? 'Sí' : 'No'; ?></td>
                                    <td>
                                        <button class="btn btn-success btn-accept" data-id="<?php echo $interesado['id_match']; ?>">Aceptar</button>
                                        <button class="btn btn-danger btn-reject" data-id="<?php echo $interesado['id_match']; ?>">Rechazar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No hay interesados en tus proyectos aún.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2024 CecyFriends | Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
