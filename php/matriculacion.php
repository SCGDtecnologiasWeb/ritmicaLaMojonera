<?php
$errores = array();
if (!preg_match("/^[a-zA-Z]+/", $_POST['name'])) {
  $errores[] = "Sólo se permiten letras como nombre <br>";
}
if (strlen($_POST["dni"]) != 9) {
  $errores[] = "El formato de dni es incorrecto";
}

if (!preg_match("/^[a-zA-Z]+/", $_POST["parent"])) {
  $errores[] = "Sólo se permiten letras como nombre <br>";
}
if (!preg_match("/^[1-9]+/", $_POST["whatsapp"])) {
  $errores[] = "Sólo se permiten dígitos en el telefono <br>";
  if (strlen($_POST["whatsapp"]) != 9) {
    $errores[] = "Se debe introducir el teléfono con 9 dígitos <br>";
  }
}
if (!preg_match("/^[a-zA-Z]+/", $_POST["allergies"]) && !empty($_POST["allergies"])) {
  $errores[] = "Sólo se permiten letras en las alergias <br>";
}
if (empty($errores)) {
  $nombre = filtrado($_POST["name"]);
  $fechaNac = filtrado($_POST["birthdate"]);
  $dni = filtrado($_POST["dni"]);
  $tutor = filtrado($_POST["parent"]);
  $telf = filtrado($_POST["whatsapp"]);
  $nivel = filtrado($_POST["level"]);
  $alergias = filtrado($_POST["allergies"]);
  $consentimiento = filtrado($_POST["consent"]);
  $justificante = $_POST["payment"];
  $pagado = empty($justificante);
  echo ("Correcto");
} else {
  foreach ($errores as $error) {
    echo ("<li> $error </li>");
  }
}
