<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 19/11/2024
 */
//Si el usuario no es 'administrador' o la contraseña no es '1234', pedimos las credenciales.
if (!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER'] != 'administrador' || $_SERVER['PHP_AUTH_PW'] != '1234') {
    // Si no hay autenticación o las credenciales no son correctas
    header('WWW-Authenticate: Basic Realm="Mi dominio"');
    // Código por sino esta autenticado
    header('HTTP/1.0 401 Unauthorized');
    echo("<p style='color: red;'><b>Error en la Autenticación</b></p><br>");
    echo('<button><a href="/202DWESProyectoTema5" style="text-decoration: none;">Volver</a></button>');
    exit(); // Detiene la ejecución si es incorrecta
} else {
    // Si todo esta bien se muestra los datos
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/index.css" type="text/css">
        <title>Víctor García Gordón</title>
    </head>
    <body>
        <header>
            <h1 id="inicio">Desarrollo de un control de acceso con identificación del usuario basado en la función header()</h1>
        </header>
        <main>
            <section>
                <div>
                    <div>
                        <div>
                            <?php
                            // Si la autenticación fue correcta, mostramos los datos del usuario
                            echo "<p style='color: green;'><b>Usuario y password correctos!</b></p>";

                            // Muestra el nombre de usuario
                            echo "<p>Nombre de usuario: <b>" . $_SERVER['PHP_AUTH_USER'] . "</b></p>";

                            // Muestra la contraseña
                            echo "<p style='color: black;'>Password: <b>" . $_SERVER['PHP_AUTH_PW'] . "</b></p>";
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <div>
                <a href="../indexProyectoTema5.php">Tema 5</a> 
                <a target="blank" href="../doc/curriculum.pdf"><img src="../doc/curriculum.jpg" alt="curriculum"></a>
                <a target="blank" href="https://github.com/victorgargor/202DWESProyectoTema5"><img src="../doc/github.png" alt="github"></a>
                <a target="blank" href="https://github.com">Web Imitada</a>
            </div>
        </footer>
    </body>
</html>

