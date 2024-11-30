<?php
session_start();
require 'utils/conection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conexión a la base de datos
    $conn = connection();

    if (!$conn) {
        $_SESSION['error'] = "Error al conectar con la base de datos.";
        header("Location: /index.php");
        exit();
    }

    // Obtén los datos del formulario
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    // Consulta para verificar si el usuario existe
    $stmt = $conn->prepare("SELECT id_usuario, contrasena, nombre FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['error'] = "Correo electrónico o contraseña incorrectos.";
        $stmt->close();
        $conn->close();
        header("Location: /index.php");
        exit();
    }

    // Obtener los datos del usuario
    $stmt->bind_result($id_usuario, $hashedPassword, $nombre);
    $stmt->fetch();

    // Verificar la contraseña
    if (!password_verify($password, $hashedPassword)) {
        $_SESSION['error'] = "Correo electrónico o contraseña incorrectos.";
        $stmt->close();
        $conn->close();
        header("Location: /index.php");
        exit();
    }

    // Iniciar sesión correctamente
    $_SESSION['user_id'] = $id_usuario;
    $_SESSION['user_name'] = $nombre;
    $_SESSION['success'] = "Bienvenido, $nombre.";

    $stmt->close();
    $conn->close();
    header("Location: /search/index.php");
    exit();
} else {
    $_SESSION['error'] = "Método de solicitud no permitido.";
    header("Location: /index.php");
    exit();
}
?>
