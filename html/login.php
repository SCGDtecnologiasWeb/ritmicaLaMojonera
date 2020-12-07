<?php
session_start();


if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
  if ($_SESSION["tipo_usuario"] === "entrenador") {
    header("location: https://cdrlamojonera.com/html/entrenador_listado.php");
    exit;
  } else if ($_SESSION["tipo_usuario"] === "administrador") {
    header("location: https://cdrlamojonera.com/html/administrar_inscripciones.php");
    exit;
  }
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

$correo = "";
$correo_err = "";

$contraseña = "";
$contraseña_err = "";

$es_admin = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  // Comprobamos si el campo de correo esta vacio
  if (empty(trim($_POST["correo"]))) {
    $correo_err = "Por favor introduce tu correo.";
  } else {
    $correo = trim($_POST["correo"]);
  }

  // Comprobamos si el campo de contraseña esta vacio
  if (empty(trim($_POST["contraseña"]))) {
    $contraseña_err = "Por favor introduce tu contraseña.";
  } else {
    $contraseña = trim($_POST["contraseña"]);
  }

  if (empty($correo_err) && empty($contraseña_err)) {

    // Preparamos la consulta para ver si es admin
    $sql = "SELECT idAdministrador, correoAdmin, claveAccesoAdmin FROM administrador WHERE correoAdmin = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Linkamos las variables a la consulta como parametros
      mysqli_stmt_bind_param($stmt, "s", $param_correo);

      // Establecemos los parametros
      $param_correo = $correo;

      // Intentamos ejecutar la consulta
      if (mysqli_stmt_execute($stmt)) {
        // Guardamos el resultado
        mysqli_stmt_store_result($stmt);

        // Comprobamos si existe el correo
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $es_admin = true;

          // Linkamos las variables a la salida de la consulta
          mysqli_stmt_bind_result($stmt, $id_admin, $correo_admin, $hash_contraseña_admin);

          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($contraseña, $hash_contraseña_admin)) {
              // La contraseña es correcta por lo que iniciamos una nueva sesion
              session_start();

              // Guardamos las variables en el array de sesion
              $_SESSION["logged_in"] = true;
              $_SESSION["tipo_usuario"] = "administrador";
              $_SESSION["id"] = $id_admin;
              $_SESSION["correo"] = $correo_admin;

              // Redirigimos el usuario a su página inicial
              header("location: https://cdrlamojonera.com/html/administrar_inscripciones.php");
            } else {
              // Mensaje de error si la contraseña es incorrecta
              $contraseña_err = "La contraseña es incorrecta.";
            }
          }
        }
      } else {
        echo "No hay conexión con el servidor";
      }

      // Cerramos la consulta
      mysqli_stmt_close($stmt);
    }


    if ($es_admin === false) {
      // Preparamos la consulta para ver si es entrenador
      $sql = "SELECT idEntrenador, correoEntrenador, claveAcceso FROM entrenador WHERE correoEntrenador = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        // Linkamos las variables a la consulta como parametros
        mysqli_stmt_bind_param($stmt, "s", $param_correo);

        // Establecemos los parametros
        $param_correo = $correo;

        // Intentamos ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
          // Guardamos el resultado
          mysqli_stmt_store_result($stmt);

          // Comprobamos si existe el correo
          if (mysqli_stmt_num_rows($stmt) == 1) {
            // Linkamos las variables a la salida de la consulta
            mysqli_stmt_bind_result($stmt, $id_entrenador, $correo_entrenador, $hash_contraseña_entrenador);

            if (mysqli_stmt_fetch($stmt)) {
              if (password_verify($contraseña, $hash_contraseña_entrenador)) {
                // La contraseña es correcta por lo que iniciamos una nueva sesion
                session_start();

                // Guardamos las variables en el array de sesion
                $_SESSION["logged_in"] = true;
                $_SESSION["tipo_usuario"] = "entrenador";
                $_SESSION["id"] = $id_entrenador;
                $_SESSION["correo"] = $correo_entrenador;

                // Redirigimos el usuario a su página inicial
                header("location: https://cdrlamojonera.com/html/entrenador_listado.php");
              } else {
                // Mensaje de error si la contraseña es incorrecta
                $contraseña_err = "La contraseña es incorrecta.";
              }
            }
          } else {
            $correo_err = "El correo que has introducido no existe";
          }
        }

        // Cerramos la consulta
        mysqli_stmt_close($stmt);
      }
    }
  }

  // Cerramos la conexion
  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar sesión</title>

  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/login.css" />
</head>

<body>
  <div class="modal-dialog">
    <div class="main-section">
      <div class="border-0 modal-content">
        <div class="col-12 user-img text-center">
          <img src="/assets/logo_ritmica.png" width="150px" height="150px" />
        </div>
        <form action="/html/login.php" method="POST" class="formulario">
          <h1>Iniciar sesión</h1>
          <div class="form-group" id="user-group">
            <input type="text" class="form-control" placeholder="correo" name="correo" />
          </div>
          <div class="form-group" id="password-group">
            <input type="password" class="form-control" placeholder="contraseña" name="contraseña" />
          </div>
          <div class="col-12 forgot" id="forgot-icon">
            <a href="#"><i class="fas fa-caret-right"></i>¿Olvidó su contraseña?</a>
          </div>
          <div class="form-group form-button text-right">
            <button type="submit" class="btn btn-primary" name="continuar">
              <i class="fas fa-arrow-right"></i> Continuar
            </button>
          </div>

          <!-- <div class="link-button text-left">
            <a class="btn btn-primary" href="index.html" role="button"><i class="fas fa-arrow-left"></i> Volver atrás</a>
          </div> -->
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>