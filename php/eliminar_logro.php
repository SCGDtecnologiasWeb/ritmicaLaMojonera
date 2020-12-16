<?php
session_start();

if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] === true || !$_SESSION["tipo_usuario"] === "administrador") {
  header("location: /html/login.php");
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

$sql = "DELETE FROM `Victoria` WHERE `idVictoria` = (?)";
$deleteCorrecto = 0;

$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $_GET["idVictoria"]);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($link);

unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/palmares/victoria" . $_GET["idVictoria"] . ".jpg");
header("location: /html/modificar_logros.php");
