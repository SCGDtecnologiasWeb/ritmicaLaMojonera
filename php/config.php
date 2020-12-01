<?php
$host = "localhost";
$user = "root";
$password = "SergioCristianGonzaloDiego2020";
$database = "ritmica";
$link = mysqli_connect($host, $user, $password, $database);

if ($link->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $link->connect_errno . ") " . $link->connect_error . "<br/>";
} else {
    // echo "Conectado " . $link->host_info . "<br/>";
}
