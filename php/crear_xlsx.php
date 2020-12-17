<?php
session_start();

if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] === true || !$_SESSION["tipo_usuario"] === "administrador") {
  header("location: /html/login.php");
}

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

$datos = array();
array_push($datos, array("ENTRENADORES"));
array_push($datos, array("Correo", "Nombre", "DNI", "Telefono", "Grupos"));

$sql = "SELECT * FROM `Entrenador`";
$resultado = mysqli_query($link, $sql);


while ($fila = mysqli_fetch_assoc($resultado)) {
  // Obtenemos los grupos a los que entrena
  $grupos = "";
  $sql_get_grupos = "SELECT `g`.`nombre`
                     FROM `grupo_has_entrenador` `ghe` JOIN `grupo` `g` ON `ghe`.`idGrupo` = `g`.`idGrupo`
                     WHERE `ghe`.`Entrenador_idEntrenador` = {$fila["idEntrenador"]}";
  $resultado_grupos = mysqli_query($link, $sql_get_grupos);
  while ($fila_grupos = mysqli_fetch_assoc($resultado_grupos)) {
    $grupos .= $fila_grupos["nombre"] . ", ";
  }
  $grupos = substr($grupos, 0, -2);

  array_push($datos, array($fila["correoEntrenador"], $fila["nombreCompleto"], $fila["DNI"], $fila["telefono"], $grupos));
}

array_push($datos, "");
array_push($datos, array("GIMNASTAS"));
array_push($datos, array("Nombre", "DNI", "Fecha de nacimiento", "Nombre del tutor/a", "Telefono", "Nivel", "Consentimiento a fotos", "Alergias", "Pago realizado", "Inscripción completada"));

$sql = "SELECT * FROM `Gimnasta`";
$resultado = mysqli_query($link, $sql);
while ($fila = mysqli_fetch_assoc($resultado)) {
  array_push($datos, array($fila["nombreCompleto"], $fila["dni"], $fila["fechaNacimiento"], $fila["nombreTutor"], $fila["telefono"], $fila["nivel"], $fila["consentimientoFotos"], $fila["alergias"], $fila["pago"], $fila["registrado"] == 0 ? "No" : "Si"));
}

$xlsx = SimpleXLSXGen::fromArray($datos);
$xlsx->downloadAs('listado.xlsx');

$link->close();
