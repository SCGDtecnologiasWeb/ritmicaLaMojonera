<?php
include("funciones.php");

//Parseamos las variables
$nombre = filtrado($_POST["name"]);
$correo = filtrado($_POST["email"]);
$asunto = filtrado($_POST["subject"]);
$mensaje = "De " . $nombre . ": " . filtrado($_POST["message"]);

//Mandamos el correo
$to = "cdrlamojonera@gmail.com";
$headers = "From:" . $correo;
mail($to, $asunto, $mensaje, $headers);
header("location: /html/index.php");
