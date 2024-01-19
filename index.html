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

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEx-Change</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <form id="formulario-publicacion" action="publicar.php" method="post" enctype="multipart/form-data">

    <style>

        .contenedor-publicar,
        .contenedor-busqueda {
            display: none;
        }

        .contenedor-publicar.visible,
        .contenedor-busqueda.visible {
            display: block;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="header-mobile">
            <h1 class="logo"></h1>
            <button class="open-menu" id="open-menu">
                <i class="bi bi-list"></i>
            </button>
        </header>
        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <h1 class="logo">UEx-Change</h1>
            </header>
            <nav>
                <ul class="menu">
                    <li>
                        <a class="boton-menu boton-publicar" id="boton-publicar">
                            <i class="bi bi-file-earmark-plus"></i> Publicar Artículo
                        </a>
                    </li>

                    <li>
                        <a class="boton-menu boton-todas-publicaciones" href="publicacionestodas.php">
                            <i class="bi bi-globe"></i> Publicaciones
                        </a>
                    </li>

                    <li>
                        <a class="boton-menu boton-mis-publicaciones" href="mis_publicaciones.php">
                            <i class="bi bi-card-list"></i> Mis Publicaciones
                        </a>
                    </li>

                    <li>
                        <a class="boton-menu boton-chat" href="./login.php">
                            <i class="bi bi-chat-left-dots"></i> Cerrar sesion
                        </a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© 2023 UEx-Change</p>
            </footer>
        </aside>
        <main>

        <h2 class="titulo-principal" id="titulo-principal">Publicaciones</h2>

            <div id="contenedor-publicar" class="contenedor-publicar">
                <form id="formulario-publicacion" enctype="multipart/form-data">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>

                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="libros">Libros</option>
                        <option value="tecnologia">Tecnología</option>
                        <option value="asesorias">Asesorías</option>
                        <option value="moda">Modo</option>
                        <option value="calzados">Calzados</option>
                        <option value="otros">Otros</option>
                    </select>

                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required>

                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" required>

                    <label for="contacto">Información de Contacto:</label>
                    <input type="text" id="contacto" name="contacto" required>

                    <button type="submit">Publicar</button>
                </form>
            </div>

            <div id="contenedor-busqueda" class="contenedor-busqueda">
                <div id="opciones-busqueda">
                    <select id="tipo-busqueda">
                        <option value="tecnologia">Tecnología</option>
                        <option value="asesorias">Asesorías</option>
                        <option value="moda">Moda</option>
                        <option value="libros">Libros</option>
                        <option value="herramientas">Herramientas</option>
                    </select>
                    <input type="text" id="texto-busqueda" placeholder="Buscar...">
                    <button id="boton-realizar-busqueda">Buscar</button>
                </div>
            </div>
     
            <div id="contenedor-publicaciones" class="contenedor-publicaciones">

                <?php

                $sql = "SELECT * FROM publicaciones";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                    }
                }
                ?>
            </div>
        </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/menu.js"></script>
    <script>

        const botonPublicar = document.getElementById("boton-publicar");
        const contenedorPublicar = document.getElementById("contenedor-publicar");

        botonPublicar.addEventListener("click", () => {

            if (contenedorPublicar.style.display === "none" || contenedorPublicar.style.display === "") {
                contenedorPublicar.style.display = "block";
            } else {
                contenedorPublicar.style.display = "none";
            }
        });

        const botonBuscarPublicaciones = document.getElementById("boton-buscar-publicaciones");
        const contenedorBusqueda = document.getElementById("contenedor-busqueda");

        botonBuscarPublicaciones.addEventListener("click", () => {
            if (contenedorBusqueda.style.display === "none" || contenedorBusqueda.style.display === "") {
                contenedorBusqueda.style.display = "block";
            } else {
                contenedorBusqueda.style.display = "none";
            }
        });

        const botonRealizarBusqueda = document.getElementById("boton-realizar-busqueda");
        botonRealizarBusqueda.addEventListener("click", () => {
            const tipoBusqueda = document.getElementById("tipo-busqueda").value;
            const textoBusqueda = document.getElementById("texto-busqueda").value;
        });
    </script>
</body>
</html>