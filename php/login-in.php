<?php
$usuario = $_POST["usuario"];
$contraseña = $_POST["contraseña"];
session_start();
require_once("config.php");
/* Realizamos una consulta por cada tabla para buscar en que tabla se encuentra 
el usuario que está intentando acceder */
$administrador = "SELECT * FROM Administrador WHERE correoAdmin ='$usuario'AND claveAccesoAdmin ='$contraseña'";
$entrenador = "SELECT * FROM Entrenador WHERE correoEntrenador = '" . $usuario . "' AND claveAcceso ='" . $contraseña . "'";
$resultadoAdmin = mysqli_query($link, $administrador);
$resultadoEntrenador = mysqli_query($link, $entrenador);

$filasAdmin = mysqli_num_rows($resultadoAdmin);
$filasEntrenador = mysqli_num_rows($resultadoEntrenador);
if (isset($_POST["continuar"])) {
  //AQUI SI ENTRA
  if (strlen($filasAdmin) > 0) {
    //AQUI NO ENTRA
    echo "AAAAA";

    while ($filaAdmin = mysqli_fetch_assoc($resultadoAdmin)) {
      $bdUsuarioAdmin = $filaAdmin['correoAdmin'];
      $bdClaveAdmin = $filaAdmin['claveAccesoAdmin'];
    }
    if ($usuario == $bdUsuarioAdmin && $contraseña == $bdClaveAdmin) {

      $_SESSION['administrador'] = $usuario;
      header("Location: administrar_usuarios.php");
    }
  } else if (strlen($filasEntrenador) > 0) {
    session_start();
    while ($filaEntrenador = mysqli_fetch_assoc($resultadoEntrenador)) {
      $bdUsuarioEntrenador = $filaEntrenador['correoEntrenador'];
      $bdClaveEntrenador = $filaEntrenador['claveAcceso'];
    }
    if ($usuario == $bdUsuarioEntrenador && $contraseña == $bdClaveEntrenador) {
      $_SESSION['entrenador'] = $usuario;
      header("Location: entrenador_listado.php");
    }
  } else {
    $mensajeaccesoincorrecto = "El usuario y la contraseña son incorrectos, por favor vuelva a introducirlos.";
    echo $mensajeaccesoincorrecto;
  }
}
mysqli_free_result($resultadoAdmin);
mysqli_free_result($resultadoEntrenador);
mysqli_close($link);
