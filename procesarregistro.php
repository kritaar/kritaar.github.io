<?php
session_start();
include 'gestor_sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "uexchange";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: register.php?error=nombre_existente");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: register.php?error=correo_existente");
        exit();
    }

    // Utilizar Argon2 para cifrar la contraseña
    $opciones = [
        'memory_cost' => 1<<17, // 128 MB
        'time_cost' => 4,
        'threads' => 2,
    ];

    $hashed_password = password_hash($contrasena, PASSWORD_ARGON2ID, $opciones);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $hashed_password);
    $stmt->execute();

    $_SESSION["usuario"] = $nombre;

    header("Location: index.php");
    exit();
} else {
    header("Location: register.php");
    exit();
}
?>
