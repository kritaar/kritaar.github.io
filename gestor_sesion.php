<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function iniciarSesion($id_usuario) {
    $_SESSION['id_usuario'] = $id_usuario;

    $archivo = 'id_usuario.txt';
    file_put_contents($archivo, $id_usuario);
}

function obtenerIdUsuario() {

    if (isset($_SESSION['id_usuario'])) {
        return $_SESSION['id_usuario'];
    } else {
        // Si no está en la sesión, intenta obtenerlo desde el archivo
        $archivo = 'id_usuario.txt';
        return file_exists($archivo) ? file_get_contents($archivo) : null;
    }
}
?>
