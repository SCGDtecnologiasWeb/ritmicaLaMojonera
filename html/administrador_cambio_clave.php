<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
  header("location: /html/login.php");
  exit;
}
?>

<?php
$oldPass = "";
$newPass = "";
$confirmPass = "";
$newPass_err = "";
$oldPass_err = "";
$confirmPass_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $oldPass = $_POST["oldPass"];
  $newPass = $_POST["newPass"];
  $confirmPass = $_POST["confirmPass"];

  // Errores en la contraseña antigua
  if (strlen($oldPass) === 0) {
    $oldPass_err .= "No has introducido tu contraseña antigua<br>";
  }
  require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
  $sql_get_hash = "SELECT `claveAccesoAdmin` FROM `Administrador` WHERE `idAdministrador` = {$_SESSION["id"]}";
  $resultado = mysqli_query($link, $sql_get_hash);
  $fila = mysqli_fetch_assoc($resultado);
  $old_hash = $fila["claveAccesoAdmin"];
  if (!password_verify($oldPass, $old_hash)) {
    $oldPass_err .= "La contraseña es incorrecta<br>";
    mysqli_close($link);
  }

  // Errores en la nueva contraseña
  if (strlen($newPass) === 0) {
    $newPass_err .= "No has introducido tu nueva contraseña<br>";
  }
  if (strlen($newPass) < 8) {
    $newPass_err .= "La contraseña debe tener al menos 8 caracteres<br>";
  }
  if (strlen($newPass) > 20) {
    $newPass_err .= "La contraseña no puede sobrepasar 20 caracteres<br>";
  }
  if (!preg_match('/[a-zA-Z]/', $newPass)) {
    $newPass_err .= "La contraseña debe tener al menos una letra<br>";
  }
  if (!preg_match('/\d/', $newPass)) {
    $newPass_err .= "La contraseña debe contener al menos un número<br>";
  }

  // Errores en la confirmación de contraseña
  if (strlen($confirmPass) === 0) {
    $confirmPass_err .= "No has confirmado tu nueva contraseña<br>";
  }
  if ($confirmPass !== $newPass) {
    $confirmPass_err .= "Las contraseñas no coinciden<br>";
  }

  if (empty($oldPass_err) && empty($newPass_err) && empty($confirmPass_err)) {
    $new_hash = password_hash($newPass, PASSWORD_DEFAULT);

    $sql_update_pass = "UPDATE `Administrador` SET `claveAccesoAdmin` = '{$new_hash}' WHERE `idAdministrador` = {$_SESSION["id"]}";
    mysqli_query($link, $sql_update_pass);
    mysqli_close($link);
    header("location: /html/administrar_usuarios.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cambio contraseña</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/administrador_cambiar_clave.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Usuarios", "Registrar gimnasta");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Cambiar contraseña</h1>
      <div class="form-container">
        <form action="/html/administrador_cambio_clave.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="contraseña" class="form-label">Contraseña actual</label>
            <input class="form-control <?php if (!empty($oldPass_err)) echo "is-invalid" ?>" type="password" id="oldPass" name="oldPass" required>
            <div class="invalid-feedback">
              <?php
              echo $oldPass_err;
              ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="newPass" class="form-label">Nueva contraseña</label>
            <input class="form-control <?php if (!empty($newPass_err)) echo "is-invalid" ?>" type="password" id="newPass" name="newPass" required>
            <div class="invalid-feedback">
              <?php
              echo $newPass_err;
              ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="confirmPass" class="form-label">Confirmar contraseña</label>
            <input class="form-control <?php if (!empty($confirmPass_err)) echo "is-invalid" ?>" type="password" id="confirmPass" name="confirmPass" required>
            <div class="invalid-feedback">
              <?php
              echo $confirmPass_err;
              ?>
            </div>
          </div>

          <div class="alertChangePass" style="display: none;"></div>

          <button type="submit" class="btn btn-primary float-end" id="submit">Enviar</button>

        </form>
      </div>
    </div>
  </div>
  <!--Content End-->

  <!--JQuery-->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      // Setup
      if ($("#oldPass").hasClass("is-invalid")) {
        oldPassValid = false;
      } else {
        validateOldPass();
      }
      if ($("#newPass").hasClass("is-invalid")) {
        newPassValid = false;
      } else {
        validateNewPass();
      }
      if ($("#confirmPass").hasClass("is-invalid")) {
        confirmPassValid = false;
      } else {
        validateConfirmPass();
      }
      validate();

      // Comprobamos cuando se apriete una tecla
      $("#oldPass").keyup(function() {
        validateOldPass();
        validate();
      });

      $("#newPass").keyup(function() {
        validateNewPass();
        validate();
      });

      $("#confirmPass").keyup(function() {
        validateConfirmPass();
        validate();
      });

      function validateOldPass() {
        if ($("#oldPass").val().length == 0) {
          $("#oldPass").removeClass("is-invalid");
          oldPassValid = false;
          return;
        }
        $("#oldPass").removeClass("is-invalid");
        oldPassValid = true;
      }

      function validateNewPass() {
        if ($("#newPass").val().length == 0) {
          $("#newPass").removeClass("is-invalid");
          newPassValid = false;
          return;
        } else if ($("#newPass").val().length < 8) {
          $("#newPass").addClass("is-invalid");
          $("#newPass").next().html("La contraseña debe tener al menos 8 caracteres");
          newPassValid = false;
          return;
        } else if ($("#newPass").val().length > 20) {
          $("#newPass").addClass("is-invalid");
          $("#newPass").next().html("La contraseña no puede sobrepasar 20 caracteres");
          newPassValid = false;
          return;
        } else if (!/[a-zA-Z]/.test($("#newPass").val())) {
          $("#newPass").addClass("is-invalid");
          $("#newPass").next().html("La contraseña debe tener al menos una letra");
          newPassValid = false;
          return;
        } else if (!/\d/.test($("#newPass").val())) {
          $("#newPass").addClass("is-invalid");
          $("#newPass").next().html("La contraseña debe contener al menos un número");
          newPassValid = false;
          return;
        }
        $("#newPass").removeClass("is-invalid");
        newPassValid = true;
      }

      function validateConfirmPass() {
        if ($("#confirmPass").val().length == 0) {
          $("#confirmPass").removeClass("is-invalid");
          confirmPassValid = false;
          return;
        } else if ($("#confirmPass").val() !== $("#newPass").val()) {
          $("#confirmPass").addClass("is-invalid");
          $("#confirmPass").next().html("Las contraseñas no coinciden");
          confirmPassValid = false;
          return;
        }
        $("#confirmPass").removeClass("is-invalid");
        confirmPassValid = true;
      }

      function validate() {
        if (oldPassValid && newPassValid && confirmPassValid) {
          $("#submit").prop("disabled", false);
        } else {
          $("#submit").prop("disabled", true);
        }
      }

    });
  </script>
</body>

</html>