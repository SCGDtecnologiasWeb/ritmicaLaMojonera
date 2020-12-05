<?php
include("funciones.php");

//Parseamos las variables
$img = $_FILES["trophy-image"];

//Conectamos a la base de datos
require_once("config.php");
//Creamos el código para insertar
$sql1 = "REPLACE INTO `FotoGaleria` (`subido`) VALUES ('TRUE')";
$sql2 = "SELECT `idGaleria` FROM `FotoGaleria`ORDER BY idGaleria DESC LIMIT 1";

//Ejecutamos
if (mysqli_query($link, $sql1)) {
    $resultado = mysqli_query($link, $sql2);
    $fila =  mysqli_fetch_assoc($resultado);
    $idG = $fila['idGaleria'];

    //Guardamos la imagen
    $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/galeria/";
    $nombre_archivo = "galeria" . $idG . ".jpg";
    $ruta_archivo = $directorio . $nombre_archivo;
    $uploadOk = 1;

    //Comprobamos que sea una imagen
    $check = getimagesize($img["tmp_name"]);
    if ($check !== false) {
        echo "Es una imagen de tipo " . $check["mime"] . "<br>";
    } else {
        echo "No es una imagen" . "<br>";
        $uploadOk = 0;
    }

    // Comprueba el tamaño de la imagen, limite de 500kB
    if ($img["size"] > 500000) {
        echo "Tamaño de imagen demasiado grande" . "<br>";
        $uploadOk = 0;
    }

    //Intentamos subir la imagen
    if ($uploadOk == 1) {
        if (move_uploaded_file($img["tmp_name"], $ruta_archivo)) {
            echo "La imagen " . htmlspecialchars(basename($img["name"])) . " se ha subido correctamente" . "<br>";
        } else {
            echo "Ha habido un error al subir la imagen" . "<br>";
            header("location: /html/anadir_imagenes.html");
        }
    } else {
        echo "No podemos subir la imagen" . "<br>";
        header("location: /html/anadir_imagenes.php");
    }

    header("location: /html/administrar_usuarios.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
    header("location: /html/anadir_imagenes.php");
}
mysqli_close($link);
