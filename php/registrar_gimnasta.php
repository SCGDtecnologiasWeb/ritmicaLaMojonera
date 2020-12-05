<?php
include("funciones.php");

//Parseamos las variables
$nombre = filtrado($_POST["name"]);
$fechaNac = filtrado($_POST["birthdate"]);
$dni = str_replace("-", "", str_replace(" ", "", strtoupper(filtrado($_POST["dni"]))));
$tutor = filtrado($_POST["parent"]);
$telf = str_replace(" ", "", filtrado($_POST["whatsapp"]));
$nivel = filtrado($_POST["level"]);
$alergias = (empty($_POST["allergies"]) ? filtrado($_POST["allergies"]) : NULL);
$consentimiento = filtrado($_POST["consent"]);
$imagen_pago = $_FILES['payment'];
$pagado = (is_uploaded_file($imagen_pago['tmp_name']) ? "Si" : "No");

//Conectamos a la base de datos
require_once("config.php");
//Creamos el código para insertar
$sql = "REPLACE INTO Gimnasta (dni,nombreCompleto,fechaNacimiento,nombreTutor,telefono,nivel,consentimientoFotos,alergias,pago,registrado) VALUES ('$dni','$nombre','$fechaNac','$tutor','$telf','$nivel','$consentimiento','$alergias','$pagado','FALSE')";
//Ejecutamos
if (mysqli_query($link, $sql)) {
    if (is_uploaded_file($imagen_pago['tmp_name'])) { //Guardamos la imagen
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/matriculaciones/";
        $nombre_archivo = $dni . ".jpg";
        $ruta_archivo = $directorio . $nombre_archivo;
        $uploadOk = 1;

        //Comprobamos que sea una imagen
        $check = getimagesize($imagen_pago["tmp_name"]);
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
            if (move_uploaded_file($imagen_pago["tmp_name"], $ruta_archivo)) {
                echo "La imagen " . htmlspecialchars(basename($imagen_pago["name"])) . " se ha subido correctamente" . "<br>";
            } else {
                echo "Ha habido un error al subir la imagen" . "<br>";
                header("location: /html/registrar_gimnasta.html");
            }
        } else {
            echo "No podemos subir la imagen" . "<br>";
            header("location: /html/registrar_gimnasta.html");
        }
    }
    header("location: /html/administrar_usuarios.html");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
    header("location: /html/registrar_gimnasta.html");
}
mysqli_close($link);
