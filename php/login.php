<?php
include("funciones.php");
$alert = '';
$usuario = $_POST["usuario"];
$contraseña = $_POST["contraseña"];
session_start();
require_once("config.php");
$queryAdmin = mysqli_query($link, "SELECT * FROM Administrador WHERE correoAdmin ='$usuario'AND claveAccesoAdmin ='$contraseña'");
$queryEntrenador = mysqli_query($link, "SELECT * FROM Entrenador WHERE correoEntrenador ='$usuario'AND claveAcceso ='$contraseña'");

$resultAdmin = mysqli_num_rows($queryAdmin);
$resultEntrenador = mysqli_num_rows($queryEntrenador);

if (isset($_POST["continuar"])) {
  //AQUI SI ENTRA
  if (strlen($resultAdmin) > 0) {
    //AQUI NO ENTRA
    echo "AAAAA";

    while ($resultAdmin = mysqli_fetch_assoc($queryAdmin)) {
      $bdUsuarioAdmin = $resultAdmin["correoAdmin"];
      $bdClaveAdmin = $resultAdmin["claveAccesoAdmin"];
    }
    if ($usuario == $bdUsuarioAdmin && $contraseña == $bdClaveAdmin) {

      $_SESSION["administrador"] = $usuario;
      header("Location: /html/administrar_usuarios.html");
    }
  } else  if (strlen($resultEntrenador) > 0) {
    //AQUI NO ENTRA
    echo "AAAAA";

    while ($resultEntrenador = mysqli_fetch_assoc($queryEntrenador)) {
      $bdUsuarioEntrenador = $resultEntrenador["correoEntrenador"];
      $bdClaveEntrenador = $resultEntrenador["claveAcceso"];
    }
    if ($usuario == $bdUsuarioEntrenador && $contraseña == $bdClaveEntrenador) {

      $_SESSION["entrenador"] = $usuario;
      header("Location: /html/palmares.html");
    }
  } else {
    $mensajeaccesoincorrecto = "El usuario y la contraseña son incorrectos, por favor vuelva a introducirlos.";
    echo $mensajeaccesoincorrecto;
  }
}
