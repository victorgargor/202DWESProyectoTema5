<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 20/11/2024
 */
// Configuración de conexión con la base de datos
require_once '../config/ConfDBPDO.php';

try {
    // Establecemos la conexión a la base de datos mediante PDO
    $miDB = new PDO(DSN, USER, PASSWORD);

    // Verificamos si las credenciales de autenticación existen
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header('WWW-Authenticate: Basic realm="Mi dominio"');
        header('HTTP/1.0 401 Unauthorized');
        echo("<p style='color: red;'><b>Error en la Autenticación</b></p><br>");
        echo('<button><a href="/202DWESProyectoTema5" style="text-decoration: none;">Volver</a></button>');
        exit();
    }

    // Utilizo una variable para el hash de la contraseña
    $hashPassword = hash('sha256', $_SERVER['PHP_AUTH_USER'] . $_SERVER['PHP_AUTH_PW']);

    // Consultamos si el usuario existe en la base de datos y obtenemos el hash de la contraseña
    $sql = <<<SQL
    SELECT T01_DescUsuario, T01_Password, T01_NumConexiones, T01_FechaHoraUltimaConexion
    FROM T01_Usuario
    WHERE T01_CodUsuario = '{$_SERVER['PHP_AUTH_USER']}'
    AND T01_Password = '$hashPassword'
    SQL;
    $stmt = $miDB->prepare($sql);
    $stmt->execute();

    // Obtenemos el resultado de la consulta
    $resultadoConsulta = $stmt->fetch(PDO::FETCH_OBJ);

    if ($resultadoConsulta) {
        // Si las credenciales son correctas, obtenemos los detalles del usuario
        $nombreUsuario = $resultadoConsulta->T01_DescUsuario;
        $numConexiones = $resultadoConsulta->T01_NumConexiones;
        $fechaUltimaConexion = $resultadoConsulta->T01_FechaHoraUltimaConexion;

        // Formateamos la fecha de la última conexión
        $fechaUltimaConexionFormateada = date('d/m/Y H:i:s', strtotime($fechaUltimaConexion));

        // Incrementamos el número de conexiones solo si no es la primera conexión
        if ($numConexiones > 0) {
            $nuevoNumConexiones = $numConexiones + 1;
        } else {
            // Si es la primera vez que se conecta, mantenemos el número de conexiones en 1
            $nuevoNumConexiones = 1;
        }

        // Actualizamos el número de conexiones y la fecha de la última conexión en la base de datos
        $sql2 = <<<SQL
        UPDATE T01_Usuario 
        SET T01_NumConexiones = '$nuevoNumConexiones', 
        T01_FechaHoraUltimaConexion = NOW() 
        WHERE T01_CodUsuario = '{$_SERVER['PHP_AUTH_USER']}';
        SQL;
        $stmtActualizacion = $miDB->prepare($sql2);
        $stmtActualizacion->execute();

        // Mostramos el mensaje de bienvenida dependiendo de si es la primera vez o no
        if ($numConexiones == 0) {
            echo "<p>¡Bienvenido <b>$nombreUsuario</b>! Esta es la primera vez que te conectas.</p>";
        } else {
            echo "<p>¡Bienvenido de nuevo <b>$nombreUsuario</b>! Esta es la <b>$nuevoNumConexiones</b> vez que te conectas y te conectaste por última vez el <b>$fechaUltimaConexionFormateada.</b></p>";
        }
    } else {
        // Si los datos son incorrectos
        header('WWW-Authenticate: Basic realm="Mi dominio"');
    }
} catch (PDOException $exception) {
    // Si ocurre un error en la conexión con la base de datos
    echo "<p class='mensaje-error'>Error: " . $exception->getMessage() . "</p>";
    echo "<p class='mensaje-error'>Código de error: " . $exception->getCode() . "</p><br/>";
} finally {
    unset($miDB); // Cerramos la conexión con la base de datos
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
        <main>
            <section>
                <div>
                    <div>
                        <div>
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