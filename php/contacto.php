<?php
include("funciones.php");

// Parseamos las variables
$nombre = filtrado($_POST["name"]);
$correo = filtrado($_POST["email"]);
$asunto = filtrado($_POST["subject"]);
$mensaje = "De " . $nombre . ": " . filtrado($_POST["message"]);

// Mandamos el correo
$to = "cdrlamojonera@gmail.com";
$headers = "From:" . $correo;

if (mail($to, $asunto, $mensaje, $headers)) {
  echo "Tu mensaje ha sido enviado con éxito";
} else {
  echo "Ha habido un problema, tu mensaje no ha podido ser enviado";
}
