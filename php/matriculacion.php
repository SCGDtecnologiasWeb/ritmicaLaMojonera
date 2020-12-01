<?php
include("funciones.php");

//Parseamos las variables
$nombre = filtrado($_POST["name"]);
$fechaNac = filtrado($_POST["birthdate"]);
$dni = str_replace("-", "", str_replace(" ", "", strtoupper(filtrado($_POST["dni"]))));
$tutor = filtrado($_POST["parent"]);
$telf = str_replace(" ", "", filtrado($_POST["whatsapp"]));
$nivel = filtrado($_POST["level"]);
$alergias = (empty($_POST["allergies"]) ? filtrado($_POST["allergies"]) : NULL);
$consentimiento = filtrado($_POST["consent"]);
$justificante = $_POST["payment"];
$pagado = (empty($justificante) ? "No" : "Si");

//Conectamos a la base de datos
require_once("config.php");
//Creamos el código para insertar
$sql = "REPLACE INTO Gimnasta (dni,nombreCompleto,fechaNacimiento,nombreTutor,telefono,nivel,consentimientoFotos,alergias,pago,registrado) VALUES ('$dni','$nombre','$fechaNac','$tutor','$telf','$nivel','$consentimiento','$alergias','$pagado','FALSE')";
//Ejecutamos
if (mysqli_query($link, $sql)) {
  header("location: /html/index.html");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
mysqli_close($link);
