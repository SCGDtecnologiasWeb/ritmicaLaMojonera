<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
  header("location: /html/login.php");
  exit;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

$sql = "DELETE FROM `Gimnasta` WHERE `dni` = (?)";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $_GET["idGimnasta"]);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($link);

unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/matriculaciones/" . $_GET["idGimnasta"] . ".jpg");
header("location: /html/modificar_noticias.php");
