<?php
include("funciones.php");
require_once("config.php");
if (empty($_SESSION))
  session_start();
if (!isset($_POST['continuar'])) {
  header("Location: login.php");
  exit;
}
$usuario = filtrado($_POST["usuario"]);
$contraseña = filtrado($_POST["contraseña"]);

$queryAdmin = mysqli_query($link, "SELECT * FROM Administrador WHERE correoAdmin ='$usuario'");
$queryEntrenador = mysqli_query($link, "SELECT * FROM Entrenador WHERE correoEntrenador ='$usuario'AND claveAcceso ='$contraseña'");

$resultAdmin = mysqli_num_rows($queryAdmin);
$resultEntrenador = mysqli_num_rows($queryEntrenador);

if ($resultAdmin($queryAdmin) == 0) {
  echo "NO ES VALIDO EL USUARIO";
} else {
  while ($row_query = mysqli_fetch_array($queryAdmin)) {
    if ($row_query['contraseña'] == $contraseña) {
      $_SESSION['contraseña'] = $_POST['contraseña'];
      header("Location: matriculacion.php");
      exit;
    } else {
      echo "CONTRASEÑA NO VALIDA";
    }
  }
}
