<?php
function filtrado($datos)
{
    $datos = trim($datos); // Elimina espacios antes y después de los datos
    $datos = stripslashes($datos); // Elimina backslashes \
    $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
    return $datos;
}

function validar_imagen($img)
{
    $img_err = "";

    //Comprobamos que sea una imagen
    $check = getimagesize($img["tmp_name"]);
    if ($check === false) {
        $img_err .= "No es una imagen" . "<br>";
    }
    // Comprobamos el tipo de archivo
    if ($check !== false && $check["mime"] !== "image/jpeg" && $check["mime"] !== "image/png") {
        $img_err .= "Solo archivos .jpeg, .jpg o .png" . "<br>";
    }
    // Compruebamos el tamaño de la imagen
    if ($img["size"] > 500000) {
        $img_err .= "El archivo supera el limite de 500kB" . "<br>";
    }
    return $img_err;
}

function guardar_imagen($img, $ruta)
{
    return move_uploaded_file($img["tmp_name"], $ruta);
}
