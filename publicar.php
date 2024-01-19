<?php
session_start();
include 'gestor_sesion.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "uexchange";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION["id_usuario"])) {
        $id_usuario = $_SESSION["id_usuario"];

        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $categoria = $_POST["categoria"];
        $ubicacion = $_POST["ubicacion"];
        $contacto = $_POST["contacto"];

        $nombre_imagen = $_FILES["imagen"]["name"];
        $ruta_imagen = "directorio_destino/" . $nombre_imagen;

        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);

        $sql = "INSERT INTO publicaciones (id_usuario, titulo, descripcion, categoria, imagen, ubicacion, contacto) VALUES ('$id_usuario', '$titulo', '$descripcion', '$categoria', '$nombre_imagen', '$ubicacion', '$contacto')";

        if ($conn->query($sql) === TRUE) {
            echo "La publicación se ha agregado correctamente.";
        } else {
            echo "Error al agregar la publicación: " . $conn->error;
        }
    } else {
        echo "Error: Sesión no iniciada.";
    }
}
$conn->close();
?>