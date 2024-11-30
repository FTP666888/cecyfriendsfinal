<?php
require 'config.php';

function connection() {
    try {
        $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($link->connect_error) {
            throw new Exception('Error al conectar con MySQL: ' . $link->connect_error);
        }

        return $link;
    } catch (Exception $e) {
        error_log($e->getMessage(), 0);
        echo '<p>No se pudo conectar a la base de datos. Intente más tarde.</p>';
        return null;
    }
}
?>
