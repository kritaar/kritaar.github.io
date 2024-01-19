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

// Filtro de categoría
$filtroCategoria = isset($_GET['filtroCategoria']) ? $_GET['filtroCategoria'] : '';

$sql = "SELECT publicaciones.*, usuarios.email FROM publicaciones
        JOIN usuarios ON publicaciones.id_usuario = usuarios.id";

// Aplicar filtro de categoría si se selecciona una categoría específica
if (!empty($filtroCategoria)) {
    $sql .= " WHERE publicaciones.categoria = '$filtroCategoria'";
}

$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<div class="contenedor-publicaciones">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $titulo = $row["titulo"];
            $descripcion = $row["descripcion"];
            $imagen = $row["imagen"];
            $categoria = $row["categoria"];
            $contacto = $row["contacto"];
            $email = $row["email"];
            $ruta_imagen = "directorio_destino/" . $imagen;

            if (file_exists($ruta_imagen)) {
                echo "<div class='publicacion'>";
                echo "<h3 class='publicacion-titulo'>" . $titulo . "</h3>";
                echo "<p class='publicacion-descripcion'>" . $descripcion . "</p>";
                echo "<img class='publicacion-imagen' src='" . $ruta_imagen . "' alt='" . $titulo . "'>";
                echo "<p class='publicacion-categoria'>Categoría: " . $categoria . "</p>";
                echo "<p class='publicacion-contacto'>Contacto: " . $contacto . "</p>";
                echo "<p class='publicacion-email'>Email del usuario: " . $email . "</p>";
                echo "</div>";
            } else {
                echo "Imagen no encontrada";
            }
        }
    } else {
        echo "<p class='mensaje'>No se encontraron publicaciones.</p>";
    }
    $conn->close();
    ?>
</div>
