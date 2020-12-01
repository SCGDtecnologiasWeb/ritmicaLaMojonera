<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
session_start();
$_SESSION['usuario'] = $usuario;

require_once("config.php");

$consulta = "SELECT*FROM Administrador WHERE correoAdmin='$usuario' AND claveAccesoAdmin='$contraseña'";
$resultado = mysqli_query($link, $consulta);
$filas = mysqli_num_rows($resultado);
if ($filas) {
    header("location: noticia.php");
} else {
    if (empty($_POST['usuario'])) {


?>
        <?php
        include("login.html");
        ?>
        <h1 class="bad">Por favor, introduzca su usuario</h1>
    <?php
    }
    if (empty($_POST['contraseña'])) {

    ?>
        <?php
        include("login.html");
        ?>
        <h1 class="bad">Por favor, introduzca su contraseña</h1>
<?php
    }
}

mysqli_free_result($resultado);
mysqli_close($link);
