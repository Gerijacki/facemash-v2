<?php
// Obtiene las credenciales de la base de datos desde variables de entorno
define('DB_SERVER', getenv('DB_SERVER'));
define('DB_USERNAME', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_DATABASE', getenv('DB_DATABASE'));

try {
    // Crea una nueva conexión a la base de datos
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Verifica la conexión y maneja errores si la conexión falla
    if ($mysqli->connect_error) {
        throw new Exception("No se pudo conectar a la base de datos: " . $mysqli->connect_error);
    }

    // Consulta SQL para obtener todas las noticias
    $sql = "SELECT titulo, contenido, fecha FROM noticias";
    $result = $mysqli->query($sql);

    // Array para almacenar las noticias
    $noticias = [];

    // Obtener todas las noticias y guardarlas en el array $noticias
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $noticias[] = $row;
        }
    }

    // Cerrar la conexión
    $mysqli->close();
} catch (Exception $e) {
    // Manejar cualquier excepción que pueda ocurrir durante la ejecución
    echo "Error: " . $e->getMessage();
    exit(); // Detener la ejecución del script si hay un error
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Configuración de la codificación de caracteres y el tamaño de la ventana de visualización -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página y enlace al icono en la pestaña del navegador -->
    <title>News | eduQuack</title>
    <link rel="icon" href="images/ginebro-logo (1).png">
    <!-- Enlace al archivo de estilos CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- Menú de navegación -->
    <menu>
        <img src="images/ginebro-logo (1).png">
        <ul>
            <!-- Enlaces a otras páginas del sitio web -->
            <li><a href="index.php">
                    <h3>Home</h3>
                </a></li>
            <li><a href="http://192.168.56.105:3000/">
                    <h3>Grups</h3>
                </a></li>
            <li><a href="news.php">
                    <h3 class="negrita">Notícies</h3>
                </a></li>
            <li><a href="./Foro/Blog.php">
                    <h3>Forum</h3>
                </a></li>
            <li><a href="./formularis.php">
                    <h3>Valoracións</h3>
                </a></li>
            <li><a href="perfil.php"><img id="conficon" src="images/user.png"></a></li>
        </ul>
    </menu>
    <main class="div-news">
        <!-- Contenedor para mostrar las noticias dinámicamente -->
        <div id="noticias-container"></div>
        <?php foreach ($noticias as $noticia) : ?>
            <div class="noticia">
                <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
                <p><?php echo htmlspecialchars($noticia['contenido']); ?></p>
                <p>Fecha: <?php echo htmlspecialchars($noticia['fecha']); ?></p>
            </div>
        <?php endforeach; ?>
    </main>
    <!-- Pie de página -->
    <footer>
        <!-- Enlace al archivo de licencia y dirección de correo electrónico de contacto -->
        <a href="../eduQuack/Legal/License.pdf">Tots els drets reservats a eduQuack</a>
        <p>Contactens al correu <a>example@ginebro.cat</a></p>
    </footer>
</body>

</html>
