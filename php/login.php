<?php

if (isset($_POST["continuar"])) {

    require("config.php");

    $loginNombre = $_POST["usuario"];
    $loginPassword = md5($_POST["contraseña"]);

    $consulta = "SELECT * FROM Administrador WHERE correoAdmin='$loginNombre' AND claveAccesoAdmin='$loginPassword'";

    if ($resultado = $mysqli->query($consulta)) {
        while ($row = $resultado->fetch_array()) {

            $userok = $row["usuario"];
            $passok = $row["contraseña"];
        }
        $resultado->close();
    }
    $mysqli->close();


    if (isset($loginNombre) && isset($loginPassword)) {

        if ($loginNombre == $userok && $loginPassword == $passok) {

            session_start();
            $_SESSION["logueado"] = TRUE;
            header("location: /html/index.html");
        } else {
            header("location: /html/index.html?error=login");
        }
    }
} else {
    header("location: login.php");
}
