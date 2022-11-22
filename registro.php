<?php
session_start();

//si el usuario está logeado, ¿qué hace aquí Lo echamos.
if (isset($_SESSION['usuario'])) {
    header('location: index.php');
    exit();
}
require 'lib/gestionUsuarios.php';
if ($_POST) {
    $errores = registroUsuario(
        isset($_POST['usuario']) ? $_POST['usuario'] : '',
        isset($_POST['clave']) ? $_POST['clave'] : '',
        isset($_POST['repite_clave']) ? $_POST['repite_clave'] : ''
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro de usuarios</title>
</head>

<body>
    <header>
        <h1>Sistema de autenticación</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pagina_publica.php">Página pública</a></li>
            <li><a href='login.php'>Iniciar sesión</a></li>
            <li><strong>Regístrate</strong></li>
        </ul>
    </nav>

    <main>
        <?php if (!$_POST || isset($errores)) { ?>
            <h1>Regístrate</h1>
            <form action="registro.php" method="post">
                <p>
                    <label for="usuario">Nombre de usuario</label><br>
                    <input type="text" name="usuario" id="usuario" value=<?php echo isset($_POST) && isset($errores) && isset($_POST['usuario']) ? $_POST['usuario'] : "" ?>>

                    <?php echo isset($errores) && isset($errores['usuario']) ?  "<p>" . $errores['usuario'] . "</p>" : "" ?>
                </p>
                <p>
                    <label for=" clave">Contraseña</label><br>
                    <input type="password" name="clave" id="clave">
                    <?php echo isset($errores) && isset($errores['clave']) ?  "<p>" . $errores['clave'] . "</p>" : "" ?>
                </p>
                <p>
                    <label for="repite_clave">Repite la contraseña</label><br>
                    <input type="password" name="repite_clave" id="repite_clave">
                </p>
                <p>
                    <input type="submit" value="Registrarse">
                </p>
            </form>
        <?php } else { ?>
            <h1>Te has registrado corectamente</h1>
            <h2><a href='login.php'>Ahora ve a Iniciar sesión</a></h2>
        <?php } ?>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>

</html>