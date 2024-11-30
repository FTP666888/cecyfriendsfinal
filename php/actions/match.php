<?php
session_start();
require '../utils/conection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'message' => 'Método no permitido.']));
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];
$projectId = $data['projectId'];
$userId = $_SESSION['user_id'];

$conn = connection();

// Guardar la acción con `match_confirmado` siempre en 0
$stmt = $conn->prepare("
    INSERT INTO usuario_grupo (id_grupo, id_interesado, match_confirmado)
    VALUES (?, ?, 0)
");
$stmt->bind_param("ii", $projectId, $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Acción registrada.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar la acción.']);
}

$stmt->close();
$conn->close();
?>
