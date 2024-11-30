<?php
session_start();
require '../utils/conection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Método no permitido
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

$conn = connection();
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    http_response_code(401); // No autorizado
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
    exit;
}

// Consulta para obtener el siguiente proyecto recomendado con información del propietario
$query = "
    SELECT 
        g.id_grupo, 
        g.titulo, 
        g.talentos_requeridos, 
        g.descripcion_proyecto, 
        g.recompensas, 
        g.fecha_entrega,
        u.nombre AS owner_nombre,
        p.grupo AS owner_grupo,
        p.pfp_path AS owner_foto
    FROM 
        grupo g
    JOIN 
        usuario u ON g.id_owner = u.id_usuario
    LEFT JOIN 
        perfil p ON u.id_usuario = p.id_usuario
    WHERE 
        g.id_owner != ? 
        AND NOT EXISTS (
            SELECT 1 
            FROM usuario_grupo ug 
            WHERE ug.id_grupo = g.id_grupo 
            AND ug.id_interesado = ?
        )
    ORDER BY 
        g.fecha_entrega ASC
    LIMIT 1
";

$stmt = $conn->prepare($query);
if (!$stmt) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
    exit;
}

$stmt->bind_param("ii", $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $project = $result->fetch_assoc();

    echo json_encode([
        'success' => true,
        'project' => [
            'id_grupo' => $project['id_grupo'],
            'titulo' => $project['titulo'],
            'talentos_requeridos' => $project['talentos_requeridos'],
            'descripcion_proyecto' => $project['descripcion_proyecto'],
            'recompensas' => $project['recompensas'],
            'fecha_entrega' => $project['fecha_entrega'],
            'owner_nombre' => $project['owner_nombre'],
            'owner_grupo' => $project['owner_grupo'] ?? 'Grupo desconocido',
            'owner_foto' => $project['owner_foto'] ?: '/profile/pfp/default.png',
        ],
    ]);
} else {
    http_response_code(404); // No encontrado
    echo json_encode(['success' => false, 'message' => '¡No hay más proyectos para ti!']);
}

$stmt->close();
$conn->close();
