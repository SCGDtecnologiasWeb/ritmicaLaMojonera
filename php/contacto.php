<?php
include("funciones.php");

//Parseamos las variables
$nombre = filtrado($_POST["name"]);
$correo = filtrado($_POST["email"]);
$asunto = filtrado($_POST["subject"]);
$mensaje = filtrado($_POST["message"]);

//Mandamos el correo
$to = "cristiancasado27@gmail.com";
$headers = "From:" . $correo;
mail($to, $asunto, $mensaje, $headers);
