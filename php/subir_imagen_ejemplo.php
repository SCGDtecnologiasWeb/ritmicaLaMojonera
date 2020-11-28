<?php

$directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/noticias/";
$nombre_archivo = "noticia1.jpg"; // Aqui habria que generar un nombre distinto
$ruta_archivo = $directorio . $nombre_archivo;


$imagen_noticia = $_FILES["imagen_noticia"];
$uploadOk = 1;

// Comprueba que lo que nos ha llegado sea una imagen
// isset() devuelve falso si "submit" no esta definido
// getimagesize() devulve falso si no es una imagen
if(isset($_POST["submit"])) { 
  $check = getimagesize($imagen_noticia["tmp_name"]);
  if($check !== false) {
    echo "Es una imagen de tipo " . $check["mime"] . "<br>";
  } else {
    echo "No es una imagen" . "<br>";
    $uploadOk = 0;
  }
}


// Comprueba el tamaño de la imagen, limite de 500kB
if ($imagen_noticia["size"] > 500000) {
  echo "Tamaño de imagen demasiado grande" . "<br>";
  $uploadOk = 0;
}


// Comprobar el tipo de archivo
if($check["mime"] != "image/jpeg" && $check["mime"] != "image/png") {
  echo "Solo archivos .jpeg, .jpg o .png" . "<br>";
  $uploadOk = 0;
}


// Si todo ha ido bien intentamos subir la imagen
if ($uploadOk == 1) {
  if (move_uploaded_file($imagen_noticia["tmp_name"], $ruta_archivo)) {
    echo "La imagen ". htmlspecialchars(basename($imagen_noticia["name"])). " se ha subido correctamente" . "<br>";
  } else {
    echo "Ha habido un error al subir la imagen" . "<br>";
  }
} else {
  echo "No podemos subir la imagen" . "<br>";
}
