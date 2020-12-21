<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "entrenador") {
  header("location: /html/login.php");
  exit;
}
?>

<?php
$correo = "";
$nombre = "";
$dni = "";
$telefono = "";
$grupos = array("escuela" => 0, "federada" => 0);

$email_err = "";
$name_err = "";
$dni_err = "";
$phone_err = "";
$img_err = "";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  // Obtenemos los datos del entrenador
  $sql_get_entrenador = "SELECT `correoEntrenador`, `nombreCompleto`, `DNI`, `telefono` FROM `Entrenador` WHERE `idEntrenador` = {$_SESSION["id"]}";
  $resultado = mysqli_query($link, $sql_get_entrenador);
  $fila = mysqli_fetch_assoc($resultado);
  $correo = $fila["correoEntrenador"];
  $nombre = $fila["nombreCompleto"];
  $dni = $fila["DNI"];
  $telefono = $fila["telefono"];

  // Obtenemos los grupos del entrenador
  $sql_get_grupos = "SELECT `g`.`nombre`
                     FROM `Grupo_has_Entrenador` `ghe` JOIN `Grupo` `g` ON `ghe`.`idGrupo` = `g`.`idGrupo`
                     WHERE `ghe`.`Entrenador_idEntrenador` = {$_SESSION["id"]}";
  $resultado = mysqli_query($link, $sql_get_grupos);
  while ($fila = mysqli_fetch_assoc($resultado)) {
    if ($fila["nombre"] === "Escuela") {
      $grupos["escuela"] = 1;
    } else if ($fila["nombre"] === "Federada") {
      $grupos["federada"] = 1;
    }
  }
  // Cerramos la conexion
  mysqli_close($link);
} else {
  include($_SERVER['DOCUMENT_ROOT'] . '/php/funciones.php');

  //Parseamos las variables
  $correo = filtrado($_POST["email"]);
  $nombre = filtrado($_POST["name"]);
  $dni = filtrado($_POST["dni"]);
  $telefono = filtrado($_POST["whatsapp"]);
  $telefono = str_replace(' ', '', $telefono);
  if (isset($_POST["escuela"])) {
    $grupos["escuela"] = 1;
  }
  if (isset($_POST["federada"])) {
    $grupos["federada"] = 1;
  }

  // Errores en el correo
  if (strlen($correo) === 0) {
    $email_err .= "No has introducido tu correo<br>";
  }
  if (strlen($correo) > 200) {
    $email_err .= "Dirección de correo demasiado larga<br>";
  }
  if (!preg_match('/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/', $correo)) {
    $email_err .= "No es una dirección de correo<br>";
  }
  require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
  $sql_check_email = "SELECT `idEntrenador` FROM `Entrenador` WHERE `correoEntrenador` = (?) AND `idEntrenador` <> {$_SESSION["id"]}";
  $stmt = mysqli_prepare($link, $sql_check_email);
  mysqli_stmt_bind_param($stmt, "s", $correo);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  if (mysqli_stmt_num_rows($stmt) >= 1) {
    $email_err = "Este correo ya esta siendo usado por otro usuario<br>";
  }
  mysqli_stmt_close($stmt);

  // Errores en el nombre
  if (strlen($nombre) === 0) {
    $name_err .= "No has introducido tu nombre<br>";
  }
  if (strlen($nombre) > 200) {
    $name_err .= "Nombre demasiado largo<br>";
  }
  if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ \'.-]+$/', $nombre)) {
    $name_err .= "Caracteres no validos<br>";
  }

  // Errores en el DNI
  if (strlen($dni) === 0) {
    $dni_err .= "No has introducido tu DNI<br>";
  }
  if (!preg_match('/^[0-9XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i', $dni)) {
    $dni_err .= "No es un DNI valido<br>";
  }

  // Errores el el telefono
  if (strlen($telefono) === 0) {
    $phone_err .= "No has introducido tu telefono<br>";
  }
  if (!preg_match('/^(6|7)([0-9]){2}[ -]?(([0-9]){2}[ -]?([0-9]){2}[ -]?([0-9]){2}|([0-9]){3}[ -]?([0-9]){3})$/', $telefono)) {
    $phone_err .= "Introduce un número de whatsapp valido en España<br>";
  }

  // Errores en la imagen
  if (file_exists($_FILES["perfil"]["tmp_name"])) {
    $img = $_FILES["perfil"];
    $img_err = validar_imagen($img);
  }

  // Si no hay errores continueamos con el registro del entrenador
  if (empty($email_err) && empty($name_err) && empty($dni_err) && empty($phone_err) && empty($img_err)) {

    // Actualizamos el entrenador
    $sql_update = "UPDATE `Entrenador` SET `correoEntrenador` = (?), `nombreCompleto` = (?), `DNI` = (?), `telefono` = (?) WHERE `idEntrenador` = {$_SESSION["id"]}";
    $stmt = mysqli_prepare($link, $sql_update);
    mysqli_stmt_bind_param($stmt, "ssss", $correo, $nombre, $dni, $telefono);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Borramos las relaciones en la tabla de grupos
    $sql_reset_grupos = "DELETE FROM `Grupo_has_Entrenador` WHERE Entrenador_idEntrenador = {$_SESSION["id"]}";
    mysqli_query($link, $sql_reset_grupos);

    if ($grupos["escuela"] === 1) {
      // Consultamos el id de escuela
      $sql_get_id = "SELECT `idGrupo` FROM `Grupo` WHERE `nombre` = 'Escuela'";
      $resultado = mysqli_query($link, $sql_get_id);
      $fila = mysqli_fetch_assoc($resultado);
      $id_escuela = $fila["idGrupo"];

      // Añadimos una fila a la tabla que relaciona grupos y entrenadores
      $sql_insert = "INSERT INTO `Grupo_has_Entrenador` (`idGrupo`, `Entrenador_idEntrenador`) VALUES ({$id_escuela}, {$_SESSION["id"]})";
      mysqli_query($link, $sql_insert);
    }
    if ($grupos["federada"] === 1) {
      // Consultamos el id de federada  
      $sql_get_id = "SELECT `idGrupo` FROM `Grupo` WHERE `nombre` = 'Federada'";
      $resultado = mysqli_query($link, $sql_get_id);
      $fila = mysqli_fetch_assoc($resultado);
      $id_federada = $fila["idGrupo"];

      // Añadimos una fila a la tabla que relaciona grupos y entrenadores
      $sql_insert = "INSERT INTO `Grupo_has_Entrenador` (`idGrupo`, `Entrenador_idEntrenador`) VALUES ({$id_federada}, {$_SESSION["id"]})";
      mysqli_query($link, $sql_insert);
    }

    // Guardamos la imagen
    $img_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/entrenadores/entrenador" . $_SESSION["id"] . ".jpg";
    if (isset($img)) {
      $img_src = $img["tmp_name"];
      move_uploaded_file($img_src, $img_path);
    }
    // Cerramos la conexion
    mysqli_close($link);
    header("location: /html/entrenador_listado.php");
  } else {
    mysqli_close($link);
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar datos</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/entrenador.css" />
  <link rel="stylesheet" href="/css/entrenador_datos.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_entrenador.php");

  $crumbs = array("Perfil", "Modificar datos personales");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_entrenador.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_entrenador.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Modificar datos de entrenador</h1>
      <div class="form-container">
        <form action="/html/entrenador_datos.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="email" class="form-label">Correo electronico</label>
            <input class="form-control <?php if (!empty($email_err)) echo "is-invalid" ?>" type="email" id="email" name="email" value="<?php echo $correo ?>" required>
            <div class="invalid-feedback">
              <?php echo $email_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input class="form-control <?php if (!empty($name_err)) echo "is-invalid" ?>" type="text" id="name" name="name" value="<?php echo $nombre ?>" required>
            <div class="invalid-feedback">
              <?php echo $name_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="dni" class="form-label">DNI/NIE</label>
            <input class="form-control <?php if (!empty($dni_err)) echo "is-invalid" ?>" type="text" id="dni" name="dni" minlength="9" maxlength="9" value="<?php echo $dni ?>" required>
            <div class="invalid-feedback">
              <?php echo $dni_err ?>
            </div>
          </div>

          <label for="whatsapp" class="form-label">Teléfono (Whatsapp)</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="prefijo-tlf">+34</span>
            <input class="form-control <?php if (!empty($phone_err)) echo "is-invalid" ?>" type="text" id="whatsapp" name="whatsapp" minlength="9" maxlength="12" value="<?php echo $telefono ?>" required>
            <div class="invalid-feedback">
              <?php echo $phone_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Grupos</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="escuela" name="escuela" <?php if ($grupos["escuela"] === 1) echo "checked" ?>>
              <label class="form-check-label" for="escuela">Escuela</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="federada" name="federada" <?php if ($grupos["federada"] === 1) echo "checked" ?>>
              <label class="form-check-label" for="federada">Federada</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="perfil" class="form-label">Foto perfil</label>
            <input class="form-control <?php if (!empty($img_err)) echo "is-invalid" ?>" autocomplete="off" type="file" id="perfil" name="perfil" accept="image/png, image/jpeg">
            <div class="invalid-feedback">
              <?php echo $img_err ?>
            </div>
          </div>

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
      if ($("#email").hasClass("is-invalid")) {
        emailValid = false;
      } else {
        validateEmail();
      }
      if ($("#name").hasClass("is-invalid")) {
        nameValid = false;
      } else {
        validateName();
      }
      if ($("#dni").hasClass("is-invalid")) {
        dniValid = false;
      } else {
        validateDNI();
      }
      if ($("#whatsapp").hasClass("is-invalid")) {
        whatsappValid = false;
      } else {
        validateWhatsapp();
      }
      perfilValid = true;

      validate();

      // Comprobamos cuando se apriete una tecla
      $("#email").keyup(function() {
        validateEmail();
        validate();
      });
      $("#name").keyup(function() {
        validateName();
        validate();
      });
      $("#dni").keyup(function() {
        validateDNI();
        validate();
      });
      $("#whatsapp").keyup(function() {
        validateWhatsapp();
        validate();
      });
      $("#perfil").change(function() {
        validatePerfil();
        validate();
      });


      function validateEmail() {
        if ($("#email").val().length == 0) {
          $("#email").removeClass("is-invalid");
          emailValid = false;
          return;
        } else if ($("#email").val().length > 200) {
          $("#email").addClass("is-invalid");
          $("#email").next().html("Dirección de correo demasiado larga");
          emailValid = false;
          return;
        } else if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($("#email").val())) {
          $("#email").addClass("is-invalid");
          $("#email").next().html("Introduce una dirección de correo");
          emailValid = false;
          return;
        }
        $("#email").removeClass("is-invalid");
        emailValid = true;
      }

      function validateName() {
        if ($("#name").val().length == 0) {
          $("#name").removeClass("is-invalid");
          nameValid = false;
          return;
        } else if ($("#name").val().length > 200) {
          $("#name").addClass("is-invalid");
          $("#name").next().html("Nombre demasiado largo");
          nameValid = false;
          return;
        } else if (!/^[A-Za-zÀ-ÖØ-öø-ÿ '.-]+$/.test($("#name").val())) {
          $("#name").addClass("is-invalid");
          $("#name").next().html("Caracteres no validos");
          nameValid = false;
          return;
        }
        $("#name").removeClass("is-invalid");
        nameValid = true;
      }

      function validateDNI() {
        if ($("#dni").val().length == 0) {
          $("#dni").removeClass("is-invalid");
          dniValid = false;
          return;
        } else if (!/^[0-9XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i.test($("#dni").val())) {
          $("#dni").addClass("is-invalid");
          $("#dni").next().html("Introduce un DNI");
          dniValid = false;
          return;
        }
        $("#dni").removeClass("is-invalid");
        dniValid = true;
      }

      function validateWhatsapp() {
        if ($("#whatsapp").val().length == 0) {
          $("#whatsapp").removeClass("is-invalid");
          whatsappValid = false;
          return;
        } else if (!/^(6|7)([0-9]){2}[ -]?(([0-9]){2}[ -]?([0-9]){2}[ -]?([0-9]){2}|([0-9]){3}[ -]?([0-9]){3})$/.test($("#whatsapp").val())) {
          $("#whatsapp").addClass("is-invalid");
          $("#whatsapp").next().html("Introduce un número de whatsapp valido en España");
          whatsappValid = false;
          return;
        }
        $("#whatsapp").removeClass("is-invalid");
        whatsappValid = true;
      }

      function validatePerfil() {
        file = $("#perfil")[0].files[0];
        if (!/^.*\.(JPG|JPEG|PNG)$/i.test(file.name)) {
          $("#perfil").addClass("is-invalid");
          $("#perfil").next().html("Solo archivos .jpeg, .jpg o .png");
          perfilValid = false;
          return;
        } else if (file.type != "image/jpeg" && file.type != "image/png") {
          $("#perfil").addClass("is-invalid");
          $("#perfil").next().html("No es una imagen");
          perfilValid = false;
          return;
        } else if (file.size > 500000) {
          $("#perfil").addClass("is-invalid");
          $("#perfil").next().html("Supera el limite de 500kB");
          perfilValid = false;
          return;
        }
        $("#perfil").removeClass("is-invalid");
        perfilValid = true;
      }

      function validate() {
        if (emailValid && nameValid && dniValid && whatsappValid && perfilValid) {
          $("#submit").prop("disabled", false);
        } else {
          $("#submit").prop("disabled", true);
        }
      }

    });
  </script>

</body>

</html>