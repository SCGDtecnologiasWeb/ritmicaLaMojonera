<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

require_once("config.php");
/* Realizamos una consulta por cada tabla para buscar en que tabla se encuentra 
el usuario que está intentando acceder */
$administrador = "SELECT * FROM Administrador WHERE correoAdmin = '$usuario' AND claveAccesoAdmin = '$contraseña'";
$entrenador = "SELECT * FROM Entrenador WHERE correoEntrenador = '$usuario' AND claveAcceso = '$contraseña'";
$resultadoAdmin = mysqli_query($link, $administrador);
$resultadoEntrenador = mysqli_query($link, $entrenador);
$filasAdmin = mysqli_num_rows($resultadoAdmin);
$filasEntrenador = mysqli_num_rows($resultadoEntrenador);
if ($filasAdmin > 0) {
    session_start();
    $_SESSION["administrador"] = $usuario;

    /* Nos dirigimos al espacio de los alumnos usando header que nos 
    redireccionará a la página que le indiquemos */
    header("location: administrar_usuarios.php");

    /* terminamos la ejecución ya que si redireccionamos ya no nos interesa 
    seguir ejecutando código de este archivo */
    exit();
} else if ($filasEntrenador > 0) {
    session_start();
    $_SESSION["entrenador"] = $usuario;


    header("location: entrenador_listado.php");
    exit();
} else {
    $mensajeaccesoincorrecto = "El usuario y la contraseña son incorrectos, por favor vuelva a introducirlos.";
    echo $mensajeaccesoincorrecto;
}
mysqli_free_result($resultadoAdmin);
mysqli_free_result($resultadoEntrenador);
mysqli_close($link);
