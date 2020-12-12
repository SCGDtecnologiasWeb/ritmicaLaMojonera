<?php
include("funciones.php");

//Parseamos las variables
$correo = filtrado($_POST["email"]);
$contraseña = filtrado($_POST["password"]);
$nombre = filtrado($_POST["name"]);
$dni = str_replace("-", "", str_replace(" ", "", strtoupper(filtrado($_POST["dni"]))));
$telf = str_replace(" ", "", filtrado($_POST["whatsapp"]));
$nivel = filtrado($_POST["level"]);
$foto = $_FILES["perfil"];
$idEntrenador = $_POST["idEntrenador"];

//Conectamos a la base de datos
require_once("config.php");
//Creamos el código para insertar
$sql1 = "REPLACE INTO `Entrenador` (`correoEntrenador`, `nombreCompleto`, `claveAcceso`, `DNI`, `telefono`) VALUES ('$correo','$nombre','$contraseña','$dni','$telf') WHERE idEntrenador = $idEntrenador";

//Ejecutamos
if (mysqli_query($link, $sql1)) {

    if (is_uploaded_file($foto['tmp_name'])) { //Guardamos la imagen
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/entrenadores/";
        $nombre_archivo = "entrenador" . $idEntrenador . ".jpg";
        $ruta_archivo = $directorio . $nombre_archivo;
        $uploadOk = 1;

        //Comprobamos que sea una imagen
        $check = getimagesize($foto["tmp_name"]);
        if ($check !== false) {
            echo "Es una imagen de tipo " . $check["mime"] . "<br>";
        } else {
            echo "No es una imagen" . "<br>";
            $uploadOk = 0;
        }

        // Comprueba el tamaño de la imagen, limite de 500kB
        if ($foto["size"] > 500000) {
            echo "Tamaño de imagen demasiado grande" . "<br>";
            $uploadOk = 0;
        }

        //Intentamos subir la imagen
        if ($uploadOk == 1) {
            if (move_uploaded_file($foto["tmp_name"], $ruta_archivo)) {
                echo "La imagen " . htmlspecialchars(basename($foto["name"])) . " se ha subido correctamente" . "<br>";
            } else {
                echo "Ha habido un error al subir la imagen" . "<br>";
                header("location: /html/entrenador_datos.php");
            }
        } else {
            echo "No podemos subir la imagen" . "<br>";
            header("location: /html/registrar_entrenador.php");
        }
    }
    header("location: /html/entrenador_datos.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
    header("location: /html/entrenador_datos.php");
}
mysqli_close($link);