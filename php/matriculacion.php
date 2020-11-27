<?php
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
}
