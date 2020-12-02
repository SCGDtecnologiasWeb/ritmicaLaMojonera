<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header("location: administrar_usuarios.php");
} else {
  if (!empty($_POST)) {
    if (empty($_POST["usuario"]) || empty($_POST["contraseña"])) {
      $alert = 'Ingrese usuario y contraseña';
    } else {

      require_once "config.php";
      $usuario = $_POST["usuario"];
      $contraseña = $_POST["contraseña"];
      $queryAdmin = mysqli_query($link, "SELECT * FROM Administrador WHERE correoAdmin ='$usuario'AND claveAccesoAdmin ='$contraseña'");
      $resultAdmin = mysqli_num_rows($queryAdmin);

      if (strlen($resultAdmin) > 0) {
        echo "ENTRA";
        $data = mysqli_fetch_array($queryAdmin);

        $_SESSION["active"] = true;
        $_SESSION["idAdministrador"] = $data["idAdministrador"];
        $_SESSION["correoAdmin"] = $data["correoAdmin"];
        $_SESSION["claveAccesoAdmin"] = $data["claveAccesoAdmin"];
        header("location: administrar_usuarios.php");
      } else {
        $alert = 'El usuario o la contraseña son incorrectos';
        session_destroy();
      }
    }
  }
}
