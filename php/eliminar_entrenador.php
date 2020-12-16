<?php
session_start();

if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] === true || !$_SESSION["tipo_usuario"] === "administrador") {
  header("location: /html/login.php");
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

$sql = "DELETE FROM `Entrenador` WHERE `idEntrenador` = (?)";

$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $_GET["idEntrenador"]);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($link);

unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/entrenadores/entrenador" . $_GET["idEntrenador"] . ".jpg");
header("location: /html/administrar_usuarios.php");
