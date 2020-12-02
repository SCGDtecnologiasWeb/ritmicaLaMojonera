<?php
include("funciones.php");
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header("location: administrar_usuarios.php");
} else {
  if (!empty($_POST)) {
    if (empty(filtrado($_POST["usuario"])) || empty(filtrado($_POST["contraseña"]))) {
      $alert = 'Ingrese usuario y contraseña';
    } else {

      require_once "config.php";
      $usuario = filtrado($_POST["usuario"]);
      $contraseña = filtrado($_POST["contraseña"]);
      $queryAdmin = mysqli_query($link, "SELECT * FROM Administrador WHERE correoAdmin ='$usuario'AND claveAccesoAdmin ='$contraseña'");
      $queryEntrenador = mysqli_query($link, "SELECT * FROM Entrenador WHERE correoEntrenador ='$usuario'AND claveAcceso ='$contraseña'");

      $resultAdmin = mysqli_num_rows($queryAdmin);
      $resultEntrenador = mysqli_num_rows($queryEntrenador);

      if (strlen($resultEntrenador) > 0) {
        echo "ENTRA";
        $data = mysqli_fetch_array($queryEntrenador);

        $_SESSION["active"] = true;
        $_SESSION["idEntrenador"] = $data["idEntrenador"];
        $_SESSION["correoEntrenador"] = $data["correoEntrenador"];
        $_SESSION["nombreCompleto"] = $data["nombreCompleto"];
        $_SESSION["claveAcceso"] = $data["claveAcceso"];
        $_SESSION["DNI"] = $data["DNI"];
        $_SESSION["telefono"] = $data["telefono"];

        header("location: /html/entrenador_listado.html");
      } else if (strlen($resultAdmin) > 0) {
        echo "ENTRA";
        $data = mysqli_fetch_array($queryAdmin);

        $_SESSION["active"] = true;
        $_SESSION["idAdministrador"] = $data["idAdministrador"];
        $_SESSION["correoAdmin"] = $data["correoAdmin"];
        $_SESSION["claveAccesoAdmin"] = $data["claveAccesoAdmin"];
        header("location: /html/palmares.html");
      } else {
        $alert = 'El usuario o la contraseña son incorrectos';
        session_destroy();
      }
    }
  }
}
