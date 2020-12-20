<?php
$host = "localhost";
$user = "u818364855_root";
$password = "SergioCristianGonzaloDiego2020";
$database = "u818364855_ritmica";
$link = mysqli_connect($host, $user, $password, $database);

if ($link->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $link->connect_errno . ") " . $link->connect_error . "<br/>";
    header("location: error.php");
}
