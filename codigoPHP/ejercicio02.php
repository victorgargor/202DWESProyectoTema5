<?php
// Importamos la configuración de la base de datos
require_once '../config/ConfDBPDO.php';
// Incluimos la libreria de validacion de formularios
require_once('../core/231018libreriaValidacion.php');
try {
    // Establecer la conexión PDO
    $miDB = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $excepcion) {
    echo "<p class='mensaje-error'>Error: " . $excepcion->getMessage() . "</p>";
    echo "<p class='mensaje-error'>Código de error: " . $excepcion->getCode() . "</p><br/>";
}

// Inicialización de variables
$entradaOK = true;
$aErrores = ['usuario' => '', 'password' => ''];
$aRespuestas = ['usuario' => '', 'password' => ''];
$mensajeExito = '';
// Definición de constantes que utilizaremos en los métodos de la librería
define('OBLIGATORIO', 1);
define('OPCIONAL', 0);
// Definición de constantes para validarPassword
define('MAX_PASS', 16);
define('MIN_PASS', 2);
define('DEBIL', 1); // La contraseña admite solo letras
define('NORMAL', 2); // La contraseña admite numeros y letras
define('FUERTE', 3); // La contraseña admite si contiene al menos una letra mayúscula y un número

if (isset($_REQUEST['enviar'])) {
    // Recibir y limpiar los datos del formulario
    $usuario = $_REQUEST['usuario'];
    $password = $_REQUEST['password'];

    $aErrores['usuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['usuario'], 1000, 1, OBLIGATORIO);
    $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], MAX_PASS, MIN_PASS, DEBIL, OBLIGATORIO);

    // Recorremos el array de errores
    foreach ($aErrores as $clave => $valor) {
        if ($valor != null) {
            $entradaOK = false;
            //Limpiamos el campo si hay un error
            $_REQUEST[$clave] = '';
        }
    }

    // Si no hay errores, comprobar las credenciales
    if ($entradaOK) {
        /*// Preparar la consulta para verificar las credenciales
        $resultadoConsulta = $miDB->prepare("SELECT T01_CodUsuario, T01_Password FROM T01_Usuario WHERE T01_CodUsuario = :usuario LIMIT 1");
        // Ejecutar la consulta pasando el valor del usuario como parámetro
        $resultadoConsulta->execute(['usuario' => $usuario]);
        // Obtener el resultado de la consulta
        $usuarioDB = $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe
        if ($usuarioDB) {
            // Concatenar el nombre de usuario con la contraseña proporcionada
            $usuarioContrasenaConcatenados = $usuario.$password;
            // Cifrar la concatenación usando SHA-256
            $usuarioContrasenaCifrada = hash('sha256', $usuarioContrasenaConcatenados);
            // Verificar si la concatenación cifrada coincide con la almacenada en la base de datos
            if (hash_equals($usuarioDB['T01_Password'], $usuarioContrasenaCifrada)) {
                // Si la contraseña es correcta, mostrar mensaje de éxito
                $mensajeExito = '¡Has iniciado sesión correctamente!';
            } else {
                // Si la contraseña es incorrecta, registrar un error y marcar que la entrada no es válida
                $aErrores['password'] = 'Usuario o contraseña incorrectos.';
                $entradaOK = false; // Establecer que la entrada no es válida
            }
        } else {
            // Si el usuario no existe en la base de datos, registrar un error
            $aErrores['usuario'] = 'Usuario no encontrado.';
            $entradaOK = false; // Marcar que la entrada no es válida
        }*/
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/controlAcceso.css" type="text/css">
        <title>Víctor García Gordón</title>
    </head>
    <body>
        <header>
            <h1>Desarrollo de un control de acceso con identificación del usuario basado en la función header() y en el uso de una tabla “Usuario” de la base de datos. (PDO)</h1>
        </header>
        <main>
            <?php if ($mensajeExito) { ?>
                <p style="color:green;"><?php echo $mensajeExito; ?></p>
            <?php } ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required 
                           value="<?php echo (isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : ''); ?>" 
                           style="background-color: lightyellow">                        
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required 
                           value="<?php echo (isset($_REQUEST['password']) ? $_REQUEST['password'] : ''); ?>" 
                           style="background-color: lightyellow">                      
                </div>
                <div class="form-group">
                    <input id="enviar" name="enviar" type="submit" value="Iniciar Sesión">
                </div>
            </form>
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
y 
