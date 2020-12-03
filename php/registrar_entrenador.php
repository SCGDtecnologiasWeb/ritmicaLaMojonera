<?php
include("funciones.php");

//Parseamos las variables
$correo = filtrado($_POST["email"]);
$contraseña = filtrado($_POST["password"]);
$nombre = filtrado($_POST["name"]);
$fechaNac = filtrado($_POST["birthdate"]);
$dni = str_replace("-", "", str_replace(" ", "", strtoupper(filtrado($_POST["dni"]))));
$telf = str_replace(" ", "", filtrado($_POST["whatsapp"]));
$nivel = filtrado($_POST["level"]);
$foto = $_POST["perfil"];

//Conectamos a la base de datos
require_once("config.php");
//Creamos el código para insertar
$sql1 = "REPLACE INTO `Entrenador` (`correoEntrenador`, `nombreCompleto`, `claveAcceso`, `DNI`, `telefono`) VALUES ('$correo','$nombre','$contraseña','$dni','$telf')";
$sql2 = "SELECT `idEntrenador` FROM `Entrenador` WHERE correoEntrenador = '$correo'";

//Ejecutamos
if (mysqli_query($link, $sql1)) {
    $resultado = mysqli_query($link, $sql2);
    $fila =  mysqli_fetch_assoc($resultado);
    $idE = $fila['idEntrenador'];
    $idN = ($nivel == "Escuela" ? 1 : 2);
    $slq3 = "REPLACE INTO `Grupo_has_Entrenador`(`idGrupo`, `Entrenador_idEntrenador`) VALUES ('$idN','$idE')";
    mysqli_query($link, $sql3);
    if (!empty($justificante)) { //Guardamos la imagen
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/entrenadores/";
        $nombre_archivo = "entrenador" . $idE . ".jpg";
        $ruta_archivo = $directorio . $nombre_archivo;


        $imagen_perfil = $_FILES["perfil"];

        //Comprobamos que sea una imagen
        $check = getimagesize($imagen_perfil["tmp_name"]);
        if ($check !== false) {
            echo "Es una imagen de tipo " . $check["mime"] . "<br>";
        } else {
            echo "No es una imagen" . "<br>";
            $uploadOk = 0;
        }

        // Comprueba el tamaño de la imagen, limite de 500kB
        if ($imagen_pago["size"] > 500000) {
            echo "Tamaño de imagen demasiado grande" . "<br>";
            $uploadOk = 0;
        }

        //Intentamos subir la imagen
        if ($uploadOk == 1) {
            if (move_uploaded_file($imagen_perfil["tmp_name"], $ruta_archivo)) {
                echo "La imagen " . htmlspecialchars(basename($imagen_perfil["name"])) . " se ha subido correctamente" . "<br>";
            } else {
                echo "Ha habido un error al subir la imagen" . "<br>";
                header("location: /html/registrar_entrenador.html");
            }
        } else {
            echo "No podemos subir la imagen" . "<br>";
            header("location: /html/registrar_entrenador.html");
        }
    }
    header("location: /html/administrar_usuarios.html");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
    header("location: /html/registrar_entrenador.html");
}
mysqli_close($link);
