<?php
session_start();
require '../../php/utils/conection.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit;
}

// Verificar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

// Sanitizar y recoger datos del formulario
$id_owner = $_SESSION['user_id'];
$titulo = htmlspecialchars(trim($_POST['titulo']), ENT_QUOTES, 'UTF-8');
$talentosRequeridos = htmlspecialchars(trim($_POST['talentos_requeridos']), ENT_QUOTES, 'UTF-8');
$descripcion = htmlspecialchars(trim($_POST['descripcion_proyecto']), ENT_QUOTES, 'UTF-8');
$recompensas = htmlspecialchars(trim($_POST['recompensas']), ENT_QUOTES, 'UTF-8');
$fechaEntrega = $_POST['fecha_entrega'];

$conn = connection();

// Insertar el proyecto en la base de datos
$stmt = $conn->prepare("
    INSERT INTO grupo (id_owner, titulo, talentos_requeridos, descripcion_proyecto, recompensas, fecha_entrega)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("isssss", $id_owner, $titulo, $talentosRequeridos, $descripcion, $recompensas, $fechaEntrega);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Proyecto creado exitosamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al crear el proyecto.']);
}

$stmt->close();
$conn->close();
