<?php
session_start();







/*Comprobamos si el usuario ya ha iniciado sesion*/
if (isset($_SESSION["loggedin"]) && $_SESSION == true) {
    header("location: /html/administrar_usuarios.html");
    exit;
}
//Incluimos el archivo de config
include_once('config.php');
/*Definimos variable*/
$username = "";
$password = "";
$username_err = "";
$password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, introduzca su usuario";
        echo "Ha entrado";
    } else {
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduzca su contraseña";
    } else {
        $password = trim($_POST["password"]);
    }
    /*Validamos credenciales*/
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT idAdministrador,correoAdmin, claveAccesoAdmin FROM administrador WHERE correoAdmin = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                /*Comprobamos que el usuario existe*/
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            // almacenar datos
                            $_SESSION["loggedin"] = true;
                            $_SESSION["idAdministrador"] = $id;
                            $_SESSION["correoAdmin"] = $username;

                            // nos lleva a la pag de admin
                            header("location: /html/administrar_usuarios.html");
                        } else {
                            // si la contraseña no es valida
                            $password_err = "La contraseña que has introducido no es válida.";
                        }
                    }
                } else {
                    // Si no existe el usuario
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal, por favor vuelva a intentarlo.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
