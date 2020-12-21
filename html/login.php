<?php
session_start();


if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
  if ($_SESSION["tipo_usuario"] === "entrenador") {
    header("location: /html/entrenador_listado.php");
    exit;
  } else if ($_SESSION["tipo_usuario"] === "administrador") {
    header("location: /html/administrar_inscripciones.php");
    exit;
  }
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

$correo = "";
$contraseña = "";

$correo_err = "";
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

  if (empty($correo_err)) {

    // Preparamos la consulta para ver si es admin
    $sql = "SELECT idAdministrador, correoAdmin, claveAccesoAdmin FROM Administrador WHERE correoAdmin = ?";

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
              header("location: /html/administrar_inscripciones.php");
            } else {
              // Mensaje de error si la contraseña es incorrecta
              if (empty($contraseña_err)) {
                $contraseña_err = "La contraseña es incorrecta.";
              }
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
      $sql = "SELECT idEntrenador, correoEntrenador, claveAcceso FROM Entrenador WHERE correoEntrenador = ?";

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
                header("location: /html/entrenador_listado.php");
              } else {
                // Mensaje de error si la contraseña es incorrecta
                if (empty($contraseña_err)) {
                  $contraseña_err = "La contraseña es incorrecta.";
                }
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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
          <img src="/assets/logo_ritmica.png" width="150px" height="150px" alt="Club Rítmica La Mojonera" />
        </div>

        <h1>Iniciar sesión</h1>

        <form action="/html/login.php" method="POST" class="formulario" id="formulario">

          <div class="form-group" id="user-group">
            <input class="form-control <?php if (!empty($correo_err)) echo "is-invalid" ?>" id="correo" type="text" placeholder="correo" name="correo" value="<?php if (isset($_POST["correo"])) echo $_POST["correo"] ?>">
            <div class="invalid-feedback">
              <?php echo $correo_err ?>
            </div>
          </div>


          <div class="form-group" id="password-group">
            <input class="form-control <?php if (!empty($correo_err)) echo "is-invalid" ?>" type="password" placeholder="contraseña" name="contraseña">
            <div class="invalid-feedback">
              <?php echo $contraseña_err ?>
            </div>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="recordar">
            <label class="form-check-label" for="recordar">
              Recordar mi correo
            </label>
          </div>

          <!--Ventana emergente utilizando Ajax-->
          <!-- AJAX -->
          <div class="col-12 forgot" id="forgot-icon">
            <a href="javascript:ejecutarAJAX();" class="link" id="oContrasena"> <i class="fas fa-caret-right"></i>¿Has olvidado tu contraseña?</a>
            <!-- <div id="info"></div> -->

            <script type="text/javascript">
              function ejecutarAJAX() {
                var ajaxRequest = new XMLHttpRequest();
                ajaxRequest.onreadystatechange = function() {
                  if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
                    //document.getElementById("info").innerHTML = ajaxRequest.responseText;
                    alert(ajaxRequest.responseText);
                  }
                }

                ajaxRequest.open("GET", "document.txt", true);
                ajaxRequest.send();
              }
            </script>
          </div>

          <a href="/html/index.php">
            <button type="button" class="btn back-btn float-start">
              <i class="fas fa-undo"></i> Volver
            </button>
          </a>

          <button type="submit" class="btn btn-primary float-end" name="continuar">
            <i class="fas fa-arrow-right" style="font-size: 1.09em;"></i> Continuar
          </button>

        </form>
      </div>
    </div>
  </div>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/cookies.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $("#formulario").submit(function(event) {
        if ($("#recordar").prop("checked")) {
          if ($("#correo").val().length != 0) {
            var expiration = new Date();
            expiration.setTime(expiration.getTime() + (60000 * 60 * 24 * 30));
            setCookie("recordar-correo", $("#correo").val(), expiration);
          }
        }
      });

      var cookie = getCookie("recordar-correo");
      if (cookie != null) {
        $("#correo").val(cookie);
      }

    });
  </script>
</body>

</html>