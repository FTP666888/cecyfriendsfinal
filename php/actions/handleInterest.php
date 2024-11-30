<?php
session_start();
require '../utils/conection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit();
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit();
}

$conn = connection();

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$matchId = isset($data['matchId']) ? intval($data['matchId']) : null;
$action = isset($data['action']) ? $data['action'] : null;

if (!$matchId || !in_array($action, ['accept', 'reject'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos o inválidos.']);
    exit();
}

// Determinar el nuevo estado basado en la acción
$matchConfirmado = $action === 'accept' ? 1 : 0;

// Actualizar la tabla usuario_grupo
$stmt = $conn->prepare("UPDATE usuario_grupo SET match_confirmado = ? WHERE id_match = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conn->error]);
    exit();
}

$stmt->bind_param("ii", $matchConfirmado, $matchId);

if ($stmt->execute()) {
    $message = $action === 'accept' ? 'El interesado ha sido aceptado.' : 'El interesado ha sido rechazado.';
    echo json_encode(['success' => true, 'message' => $message]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al procesar la acción: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
