<?php
include("funciones.php");

//Parseamos las variables
$nombre = filtrado($_POST["name"]);
$fechaNac = filtrado($_POST["birthdate"]);
$dni = str_replace("-", "", str_replace(" ", "", strtoupper($_POST["dni"])));
$tutor = filtrado($_POST["parent"]);
$telf = str_replace(" ", "", filtrado($_POST["whatsapp"]));
$nivel = filtrado($_POST["level"]);
$alergias = (empty($_POST["allergies"]) ? filtrado($_POST["allergies"]) : NULL);
$consentimiento = filtrado($_POST["consent"]);
$justificante = $_POST["payment"];
$pagado = (empty($justificante) ? "No" : "Si");

//Conectamos a la base de datos
require_once("config.php");
//Creamos el código para insertar
echo ("$dni");
$sql = "REPLACE INTO Gimnasta (dni,nombreCompleto,fechaNacimiento,nombreTutor,telefono,nivel,consentimientoFotos,alergias,pago,registrado) VALUES ('$dni','$nombre','$fechaNac','$tutor','$telf','$nivel','$consentimiento','$alergias','$pagado','FALSE')";
//Ejecutamos
if (mysqli_query($link, $sql)) {
  if (!empty($justificante)) { //Guardamos la imagen
    $directorio = "/assets/matriculaciones/";
    $nombre_archivo = "$dni" . ".jpg";
    $ruta_archivo = $directorio . $nombre_archivo;
    echo ("$ruta_archivo");
    $uploadOk = 1;

    $imagen_pago = $_FILES["payment"];

    // Comprueba el tamaño de la imagen, limite de 500kB
    if ($imagen_pago["size"] > 500000) {
      echo "Tamaño de imagen demasiado grande" . "<br>";
      $uploadOk = 0;
    }

    //Intentamos subir la imagen
    if ($uploadOk == 1) {
      if (move_uploaded_file($imagen_pago['tmp_name'], $ruta_archivo)) {
        echo "La imagen " . htmlspecialchars(basename($imagen_pago["name"])) . " se ha subido correctamente" . "<br>";
      } else {
        echo "Ha habido un error al subir la imagen" . "<br>";
        //header("location: /html/matriculacion.html");
      }
    } else {
      echo "No podemos subir la imagen" . "<br>";
      //header("location: /html/matriculacion.html");
    }
  }
  //header("location: /html/index.html");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
  //header("location: /html/matriculacion.html");
}
mysqli_close($link);
