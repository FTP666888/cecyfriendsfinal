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

    // Saneamiento y validación de datos
    $nombre = htmlspecialchars(trim($_POST['register-name']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['register-email']), FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST['register-phone']), ENT_QUOTES, 'UTF-8');
    $matricula = htmlspecialchars(trim($_POST['matricula']), ENT_QUOTES, 'UTF-8');
    $password = $_POST['register-password'];

    // Validaciones adicionales
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "El correo electrónico no es válido.";
        header("Location: /index.php");
        exit();
    }

    if (!preg_match('/^\d{10}$/', $telefono)) {
        $_SESSION['error'] = "El número de teléfono debe tener exactamente 10 dígitos.";
        header("Location: /index.php");
        exit();
    }

    if (!preg_match('/^\d{15}$/', $matricula)) {
        $_SESSION['error'] = "La matrícula debe contener exactamente 15 caracteres numéricos.";
        header("Location: /index.php");
        exit();
    }

    if (strlen($nombre) < 3 || strlen($nombre) > 100) {
        $_SESSION['error'] = "El nombre debe contener entre 3 y 100 caracteres.";
        header("Location: /index.php");
        exit();
    }

    // Verificar si el email, teléfono o matrícula ya existen
    $stmt = $conn->prepare("SELECT id_usuario FROM usuario WHERE email = ? OR num_tel = ? OR matricula = ?");
    $stmt->bind_param("sss", $email, $telefono, $matricula);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "El correo electrónico, teléfono o matrícula ya están registrados.";
        $stmt->close();
        $conn->close();
        header("Location: /index.php");
        exit();
    }

    $stmt->close();

    // Hash de la contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, email, contrasena, num_tel, matricula) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $email, $passwordHash, $telefono, $matricula);

    if ($stmt->execute()) {
        // Validar si se generó el ID del usuario
        $newUserId = $conn->insert_id;
        if ($newUserId) {
            $_SESSION['new_user_id'] = $newUserId;
            $_SESSION['success'] = "Usuario registrado con éxito.";
            header("Location: /profile/complete.php");
            exit();
        } else {
            $_SESSION['error'] = "Error al obtener el ID del usuario registrado.";
        }
    } else {
        $_SESSION['error'] = "Error al registrar al usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: /index.php");
    exit();
} else {
    $_SESSION['error'] = "Método de solicitud no permitido.";
    header("Location: /index.php");
    exit();
}
