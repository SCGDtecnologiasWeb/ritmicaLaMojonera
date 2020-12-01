<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
session_start();
$_SESSION['usuario'] = $usuario;

require_once("config.php");

$consulta = "SELECT* FROM administrador WHERE correoAdmin='$usuario' AND claveAccesoAdmin='$contraseña'";
$resultado = mysqli_query($link, $consulta);
$filas = mysqli_num_rows($resultado);
if ($filas) {
    header("location: noticia.php");
} else {
    if (empty($_POST['usuario'])) {


    
        include("login.html");
    
        echo "Por favor, introduzca su usuario";
    
    }
    if (empty($_POST['contraseña'])) {

    
        
        include("login.html");
        echo "Por favor, introduzca su contraseña";
        

    }
}

mysqli_free_result($resultado);
mysqli_close($link);
