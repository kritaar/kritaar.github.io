<?php
// procesarbusqueda.php

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos de la búsqueda
    $tipoBusqueda = $_POST["tipoBusqueda"];
    $textoBusqueda = $_POST["textoBusqueda"];

    // Realizar la consulta SQL con los parámetros de búsqueda
    $sql = "SELECT * FROM publicaciones WHERE categoria = ? AND (titulo LIKE ? OR descripcion LIKE ?)";
    $stmt = $conn->prepare($sql);

    // Añadir '%' al inicio y al final del texto de búsqueda para obtener coincidencias parciales
    $textoBusqueda = "%" . $textoBusqueda . "%";

    // Bind de los parámetros y ejecución de la consulta
    $stmt->bind_param("sss", $tipoBusqueda, $textoBusqueda, $textoBusqueda);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Procesar resultados y devolverlos al frontend (puedes imprimirlos o devolverlos en formato JSON)
        while ($row = $result->fetch_assoc()) {
            // Procesar cada fila de resultados
            // Puedes imprimir o devolver estos resultados al frontend según tus necesidades
            echo "Título: " . $row["titulo"] . "<br>";
            echo "Descripción: " . $row["descripcion"] . "<br>";
            // ... Agrega más campos según sea necesario
            echo "-------------------------<br>";
        }
    } else {
        // No se encontraron resultados
        echo "No se encontraron publicaciones que coincidan con la búsqueda.";
    }

    // Cerrar la conexión y la declaración preparada
    $stmt->close();
    $conn->close();
} else {
    // Si la solicitud no es de tipo POST, redirecciona o realiza alguna otra acción según sea necesario
    header("Location: error.php");
    exit();
}
?>