<?php
session_start();

$response = [
    'error' => isset($_SESSION['error']) ? $_SESSION['error'] : '',
    'success' => isset($_SESSION['success']) ? $_SESSION['success'] : ''
];

// Limpiar los mensajes después de enviarlos
unset($_SESSION['error'], $_SESSION['success']);

header('Content-Type: application/json');
echo json_encode($response);
