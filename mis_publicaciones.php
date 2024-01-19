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

$id_usuario = obtenerIdUsuario();

$sql_publicaciones = "SELECT publicaciones.*, usuarios.email FROM publicaciones
                    JOIN usuarios ON publicaciones.id_usuario = usuarios.id
                    WHERE publicaciones.id_usuario = ?";
$stmt_publicaciones = $conn->prepare($sql_publicaciones);
$stmt_publicaciones->bind_param("i", $id_usuario);
$stmt_publicaciones->execute();
$result_publicaciones = $stmt_publicaciones->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Publicaciones</title>
    <link rel="stylesheet" href="./css/main.css">
    <style>
        .contenedor-mis-publicaciones {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .mis-publicacion {
            background-color: var(--clr-white);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
        }

        .mis-publicacion-titulo,
        .mis-publicacion-descripcion,
        .mis-publicacion-categoria,
        .mis-publicacion-contacto,
        .mis-publicacion-email {
            padding: 10px;
            margin: 0;
        }

        .mis-publicacion-imagen {
            width: 100%;
            height: auto;
            max-height: 200px;
            border-bottom: 1px solid var(--clr-gray);
        }
    </style>
</head>
<body>
    <h2 class="titulo-principal" id="titulo-principal">Mis Publicaciones</h2>

    <div class="contenedor-mis-publicaciones">
        <?php
        if ($result_publicaciones->num_rows > 0) {
            while ($row_publicaciones = $result_publicaciones->fetch_assoc()) {

                $titulo = $row_publicaciones["titulo"];
                $descripcion = $row_publicaciones["descripcion"];
                $imagen = $row_publicaciones["imagen"];
                $categoria = $row_publicaciones["categoria"];
                $contacto = $row_publicaciones["contacto"];
                $email = $row_publicaciones["email"];
                $ruta_imagen = "directorio_destino/" . $imagen;

                if (file_exists($ruta_imagen)) {
                    echo "<div class='mis-publicacion'>";
                    echo "<h3 class='mis-publicacion-titulo'>" . $titulo . "</h3>";
                    echo "<p class='mis-publicacion-descripcion'>" . $descripcion . "</p>";
                    echo "<img class='mis-publicacion-imagen' src='" . $ruta_imagen . "' alt='" . $titulo . "'>";
                    echo "<p class='mis-publicacion-categoria'>Categoría: " . $categoria . "</p>";
                    echo "<p class='mis-publicacion-contacto'>Contacto: " . $contacto . "</p>";
                    echo "<p class='mis-publicacion-email'>Email del usuario: " . $email . "</p>";
                    echo "</div>";
                } else {
                    echo "Imagen no encontrada";
                }
            }
        } else {
            echo "<p class='mensaje'>No tienes publicaciones.</p>";
        }
        $stmt_publicaciones->close();
        $conn->close();
        ?>
    </div>
</body>
</html>