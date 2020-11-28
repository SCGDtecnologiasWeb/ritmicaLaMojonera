<?php
include("funciones.php");

//Parseamos las variables
$nombre = filtrado($_POST["name"]);
$fechaNac = filtrado($_POST["birthdate"]);
$dni = filtrado($_POST["dni"]);
$tutor = filtrado($_POST["parent"]);
$telf = filtrado($_POST["whatsapp"]);
$nivel = filtrado($_POST["level"]);
$alergias = filtrado($_POST["allergies"]);
$consentimiento = filtrado($_POST["consent"]);
$justificante = $_POST["payment"];
$pagado = (empty($justificante) ? "No" : "Si");

//Conectamos a la base de datos
require_once("config.php");
//Creamos el código para insertar
$sql = "REPLACE INTO Gimnasta (dni,nombreCompleto,fechaNacimiento,nombreTutor,telefono,nivel,consentimientoFotos,alergias,pago,fotoPago,registrado) VALUES ($dni,$nombre,$fechaNac,$tutor,$telf,$nivel,$consentimiento,$alergias,$pagado,$justificante,FALSE)";
//Ejecutamos
if (mysqli_query($link, $sql)) {
  header("location: /html/index.html");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
mysqli_close($link);
