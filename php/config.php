<?php
$host = "localhost";
$user = "root";
$password = "1234";
$database = "mydb";
$link = mysqli_connect($host, $user, $password, $database);

if ($link->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $link->connect_errno . ") " . $link->connect_error . "<br/>";
} else {
    // echo "Conectado " . $link->host_info . "<br/>";
}
