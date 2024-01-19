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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas las Publicaciones</title>
    <link rel="stylesheet" href="./css/main.css">
    <style>
        .contenedor-publicaciones {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .publicacion {
            background-color: var(--clr-white);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
        }

        .publicacion-titulo,
        .publicacion-descripcion,
        .publicacion-categoria,
        .publicacion-contacto,
        .publicacion-email {
            padding: 10px;
            margin: 0;
        }

        .publicacion-imagen {
            width: 100%;
            height: auto;
            max-height: 200px;
            border-bottom: 1px solid var(--clr-gray);
        }
    </style>
</head>
<body>
    <h2 class="titulo-principal" id="titulo-principal">Publicaciones</h2>

    <label for="filtroCategoria">Filtrar por categoría:</label>
    <select id="filtroCategoria" name="filtroCategoria" onchange="cambiarCategoria()">
        <option value="">Todos</option>
        <option value="libros">Libros</option>
        <option value="tecnologia">Tecnología</option>
        <option value="asesorias">Asesorías</option>
        <option value="moda">Moda</option>
        <option value="calzados">Calzados</option>
        <option value="otros">Otros</option>
    </select>

    <div class="contenedor-publicaciones" id="contenedor-publicaciones">
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

    <script>
        function cambiarCategoria() {
            // Obtener el valor seleccionado
            var categoriaSeleccionada = document.getElementById("filtroCategoria").value;

            // Realizar una petición al servidor para obtener las publicaciones de la categoría seleccionada
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Actualizar el contenido de la página con las nuevas publicaciones
                    document.getElementById("contenedor-publicaciones").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "procesar_busqueda.php?filtroCategoria=" + categoriaSeleccionada, true);
            xhttp.send();
        }
    </script>
</body>
</html>
