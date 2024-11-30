<?php
session_start();
require 'utils/conection.php';

if (!isset($_SESSION['new_user_id'])) {
    $_SESSION['error'] = "Acceso no autorizado.";
    header("Location: /index.php");
    exit();
}

// Conexión a la base de datos
$conn = connection();
if (!$conn) {
    $_SESSION['error'] = "Error al conectar con la base de datos.";
    header("Location: /index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Saneamiento y validación de los datos
        $grupo = isset($_POST['grupo']) ? trim($_POST['grupo']) : '';
        if (empty($grupo)) {
            throw new Exception("El campo 'Grupo' es obligatorio.");
        }
        $grupo = $conn->real_escape_string($grupo);

        $talentos = isset($_POST['talentos']) ? trim($_POST['talentos']) : '';
        if (!empty($talentos)) {
            $talentos = $conn->real_escape_string($talentos); // Sanitizar talentos
        }

        // Validar y procesar la imagen de perfil
        $pfp_path = "/profile/pfp/default.png"; // Path predeterminado
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['foto_perfil']['tmp_name'];
            $fileName = $_FILES['foto_perfil']['name'];
            $fileSize = $_FILES['foto_perfil']['size'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            // Validar extensión del archivo
            if (!in_array($fileExtension, $allowedExtensions)) {
                throw new Exception("Formato de archivo no permitido. Solo se aceptan JPG y PNG.");
            }

            // Validar tamaño del archivo (máximo 2MB)
            if ($fileSize > 2 * 1024 * 1024) {
                throw new Exception("El archivo es demasiado grande. Tamaño máximo: 2MB.");
            }

            // Generar un nombre único para la imagen
            $newFileName = uniqid('perfil_') . '.' . $fileExtension;

            // Definir directorio para subir la imagen
            $uploadDir = __DIR__ . '/../profile/pfp/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $destPath = $uploadDir . $newFileName;

            // Mover archivo subido
            if (!move_uploaded_file($fileTmpPath, $destPath)) {
                throw new Exception("Error al guardar la foto. Intenta nuevamente.");
            }

            // Guardar ruta en base de datos
            $pfp_path = '/pfp/' . $newFileName;
        }

        // Insertar en la base de datos
        $stmt = $conn->prepare("INSERT INTO perfil (id_usuario, grupo, pfp_path, talentos) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }

        $id_usuario = $_SESSION['new_user_id'];
        $stmt->bind_param("isss", $id_usuario, $grupo, $pfp_path, $talentos);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Perfil completado exitosamente.";
            $_SESSION['user_id'] = $_SESSION['new_user_id'];
            unset($_SESSION['new_user_id']);
        } else {
            throw new Exception("Error al guardar el perfil: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
        header("Location: /profile/index.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: /index.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Método no permitido.";
    header("Location: /index.php");
    exit();
}
