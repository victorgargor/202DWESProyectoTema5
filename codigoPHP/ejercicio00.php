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
            <h1 id="inicio">Mostrar el contenido de las variables superglobales y phpinfo()</h1>
        </header>
        <main>
            <section>
                <?php

                /**
                 * @author Víctor García Gordón
                 * @version Fecha de última modificación 19/11/2024
                 */
                // Función para imprimir de manera ordenada las superglobales no vacías
                function mostrarSuperglobal($nombre, $variable) {
                    if (!empty($variable)) {
                        echo "<h2>$$nombre</h2>";
                        echo '<table border="1" style="border-collapse: collapse;">';
                        foreach ($variable as $key => $value) {
                            echo "<tr><td style='padding: 5px;'><strong>$key</strong></td><td style='padding: 5px;'>$value</td></tr>";
                        }
                        echo '</table>';
                    }
                }

                // Comprobar que están llenas y mostrar las variables superglobales 
                if (!empty($_SERVER)) {
                    mostrarSuperglobal('SERVER', $_SERVER);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_SERVER está vacía </h2>';
                }

                if (!empty($_GET)) {
                    mostrarSuperglobal('GET', $_GET);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_GET está vacía </h2>';
                }

                if (!empty($_POST)) {
                    mostrarSuperglobal('POST', $_POST);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_POST está vacía </h2>';
                }

                if (!empty($_FILES)) {
                    mostrarSuperglobal('FILES', $_FILES);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_FILES está vacía </h2>';
                }

                if (!empty($_COOKIE)) {
                    mostrarSuperglobal('COOKIE', $_COOKIE);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_COOKIE está vacía </h2>';
                }

                if (!empty($_SESSION)) {
                    mostrarSuperglobal('SESSION', $_SESSION);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_SESSION está vacía </h2>';
                }

                if (!empty($_ENV)) {
                    mostrarSuperglobal('ENV', $_ENV);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_ENV está vacía </h2>';
                }

                if (!empty($_REQUEST)) {
                    mostrarSuperglobal('REQUEST', $_REQUEST);
                } else {
                    echo '<h2 style="color:lightcoral;">La variable $_REQUEST está vacía </h2>';
                }

                // Mostrar la configuración de PHP
                phpinfo();
                ?>
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

