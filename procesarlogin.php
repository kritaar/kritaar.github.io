<?php
session_start();
include 'gestor_sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "uexchange";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT id, contrasena FROM usuarios WHERE nombre = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['contrasena'];

            if (password_verify($contrasena, $hashed_password)) {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["id_usuario"] = $row['id'];

                header("Location: index.php");
                exit();
            } else {
                header("Location: login.php?error=1");
                exit();
            }
        } else {
            header("Location: login.php?error=1");
            exit();
        }

        $stmt->close();
        $conn->close();
    }

} else {
    header("Location: login.php");
    exit();
}
?>