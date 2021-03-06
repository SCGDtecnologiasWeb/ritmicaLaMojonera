<?php
$nombre = "";
$fechaNac = "";
$dni = "";
$tutor = "";
$telefono = "";
$nivel = "";
$alergias = "";
$consentimiento = "";

$name_err = "";
$birthdate_err = "";
$dni_err = "";
$parent_err = "";
$phone_err = "";
$level_err = "";
$allergies_err = "";
$consent_err = "";
$img_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include($_SERVER['DOCUMENT_ROOT'] . '/php/funciones.php');

  //Parseamos las variables
  $nombre = filtrado($_POST["name"]);
  $fechaNac = filtrado($_POST["birthdate"]);
  $dni = filtrado($_POST["dni"]);
  $dni = strtoupper($dni);
  $tutor = filtrado($_POST["parent"]);
  $telefono = filtrado($_POST["whatsapp"]);
  $nivel = filtrado($_POST["level"]);
  $alergias = filtrado($_POST["allergies"]);
  $consentimiento = filtrado($_POST["consent"]);

  // Errores en el nombre
  if (strlen($nombre) === 0) {
    $name_err .= "No has introducido un nombre<br>";
  }
  if (strlen($nombre) > 200) {
    $name_err .= "Nombre demasiado largo<br>";
  }
  if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ \'.-]+$/', $nombre)) {
    $name_err .= "Caracteres no validos<br>";
  }

  // Errores en la fecha
  if (strlen($fechaNac) === 0) {
    $birthdate_err .= "No has introducido una fecha<br>";
  }
  if (!preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/', $fechaNac)) {
    $birthdate_err .= "No es una fecha<br>";
  }

  // Errores en el DNI
  if (strlen($dni) === 0) {
    $dni_err .= "No has introducido un DNI<br>";
  }
  if (!preg_match('/^[0-9XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i', $dni)) {
    $dni_err .= "No es un DNI valido<br>";
  }
  require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
  $sql_check_dni = "SELECT `dni` FROM `Gimnasta` WHERE `dni` = (?)";
  $stmt = mysqli_prepare($link, $sql_check_dni);
  mysqli_stmt_bind_param($stmt, "s", $dni);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  if (mysqli_stmt_num_rows($stmt) >= 1) {
    $dni_err = "Este DNI ya esta en uso";
  }
  mysqli_stmt_close($stmt);

  // Errores en el nombre del tutor
  if (strlen($tutor) === 0) {
    $parent_err .= "No has introducido un nombre<br>";
  }
  if (strlen($tutor) > 200) {
    $parent_err .= "Nombre demasiado largo<br>";
  }
  if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ \'.-]+$/', $tutor)) {
    $parent_err .= "Caracteres no validos<br>";
  }

  // Errores el el telefono
  if (strlen($telefono) === 0) {
    $phone_err .= "No has introducido un telefono<br>";
  }
  if (!preg_match('/^(6|7)([0-9]){2}[ -]?(([0-9]){2}[ -]?([0-9]){2}[ -]?([0-9]){2}|([0-9]){3}[ -]?([0-9]){3})$/', $telefono)) {
    $phone_err .= "Introduce un número de whatsapp valido en España<br>";
  }

  // Errores en el nivel
  if (strlen($nivel) === 0) {
    $level_err .= "No has elegido ninguna opción";
  }

  // Errores en las alergias
  if (strlen($alergias) > 200) {
    $allergies_err .= "Has superado 200 caracteres<br>";
  }

  // Errores en el consentimiento
  if (strlen($consentimiento) === 0) {
    $consent_err .= "No has elegido ninguna opción";
  }

  // Comprobamos que la imagen es valida
  if (file_exists($_FILES["payment"]["tmp_name"])) {
    $img = $_FILES["payment"];

    //Comprobamos que sea una imagen
    $check = getimagesize($img["tmp_name"]);
    if ($check === false) {
      $img_err .= "Hay un error en la imagen" . "<br>";
    }
    // Comprobamos el tipo de archivo
    if ($check !== false && $check["mime"] !== "image/jpeg" && $check["mime"] !== "image/png" && $check["mime"] !== "image/webp") {
      $img_err .= "Solo archivos .jpeg, .jpg, .png o .webp" . "<br>";
    }
    // Compruebamos el tamaño de la imagen
    if ($img["size"] > 20000000) {
      $img_err .= "El archivo superaba el limite de 20MB" . "<br>";
    }
  }

  if (empty($name_err) && empty($birthdate_err) && empty($dni_err) && empty($parent_err) && empty($phone_err) && empty($level_err) && empty($allergies_err) && empty($consent_err) && empty($img_err)) {

    $telefono = str_replace(' ', '', $telefono);
    $telefono = str_replace('-', '', $telefono);

    // Obtenemos el ID del grupo de la gimnasta
    $sql_get_id_grupo = "SELECT `idGrupo` FROM `Grupo` WHERE `nombre` = (?)";
    $stmt = mysqli_prepare($link, $sql_get_id_grupo);
    mysqli_stmt_bind_param($stmt, "s", $nivel);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idGrupo);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Insertamos la gimnasta
    $sql_insert_gimnasta = "INSERT INTO `Gimnasta` (`dni`, `nombreCompleto`, `fechaNacimiento`, `nombreTutor`, `telefono`, `nivel`, `consentimientoFotos`, `alergias`, `pago`, `registrado`, `Grupo_idGrupo`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, {$idGrupo})";
    $stmt = mysqli_prepare($link, $sql_insert_gimnasta);
    if (isset($img)) {
      $pago = "Si";
    } else {
      $pago = "No";
    }
    mysqli_stmt_bind_param($stmt, "sssssssss", $dni, $nombre, $fechaNac, $tutor, $telefono, $nivel, $consentimiento, $alergias, $pago);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if (isset($img)) {
      $img_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/matriculaciones/" . $dni . ".jpg";
      $img_src = $img["tmp_name"];
      move_uploaded_file($img_src, $img_path);
    }

    mysqli_close($link);
    header("location: /html/index.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Matriculación</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/matriculacion.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Matriculación");
  $links = array("/html/index.php", "/html/matriculacion.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Matriculación</h1>
      <div class="form-container">
        <form action="/html/matriculacion.php" method="POST" enctype="multipart/form-data">

          <div class="form-text">Los campos marcados con un asterico (*) son obligatorios</div>

          <div class="mb-3">
            <label for="name" class="form-label">Nombre completo <span class="required">*</span></label>
            <input class="form-control <?php if (!empty($name_err)) echo "is-invalid" ?>" type="text" id="name" name="name" required>
            <div class="invalid-feedback">
              <?php echo $name_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="birthdate" class="form-label">Fecha de nacimiento <span class="required">*</span></label>
            <input class="form-control <?php if (!empty($birthdate_err)) echo "is-invalid" ?>" type="date" id="birthdate" name="birthdate" required>
            <div class="invalid-feedback">
              <?php echo $birthdate_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="dni" class="form-label">DNI/NIE <span class="required">*</span></label>
            <input class="form-control <?php if (!empty($dni_err)) echo "is-invalid" ?>" placeholder="Ejemplo: 94918977R" type="text" id="dni" name="dni" minlength="9" maxlength="9" required>
            <div class="invalid-feedback">
              <?php echo $dni_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="parent" class="form-label">Nombre del padre, madre o tutor/a legal <span class="required">*</span></label>
            <input class="form-control <?php if (!empty($parent_err)) echo "is-invalid" ?>" type="text" id="parent" name="parent" required>
            <div class="invalid-feedback">
              <?php echo $parent_err ?>
            </div>
          </div>

          <label for="whatsapp" class="form-label">Teléfono de contacto (Whatsapp) <span class="required">*</span></label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="prefijo-tlf">+34</span>
            <input class="form-control <?php if (!empty($phone_err)) echo "is-invalid" ?>" placeholder="Ejemplo: 766-562-399" type="text" id="whatsapp" name="whatsapp" minlength="9" maxlength="12" required>
            <div class="invalid-feedback">
              <?php echo $phone_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="level" class="form-label">Nivel de la gimnasta <span class="required">*</span></label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="level" id="escuela" value="Escuela" required>
              <label class="form-check-label" for="escuela">Escuela</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="level" id="federada" value="Federada">
              <label class="form-check-label" for="federada">Federada</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="consent" class="form-label">¿Da su consentimiento a subir fotos en las redes sociales? <span class="required">*</span></label>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="si-consentimiento" name="consent" value="Si" required>
              <label class="form-check-label" for="si-consentimiento">Si</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="no-consentimiento" name="consent" value="No">
              <label class="form-check-label" for="no-consentimiento">No</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="allergies" class="form-label">¿Alergias o enfermedades? En caso afirmativo, indicar cuál/es</label>
            <input class="form-control <?php if (!empty($allergies_err)) echo "is-invalid" ?>" type="text" id="allergies" name="allergies">
            <div class="invalid-feedback">
              <?php echo $allergies_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="payment" class="form-label">Adjuntar justificante de pago (Opcional: Ponerse en contacto para realizar el pago)</label>
            <input class="form-control <?php if (!empty($img_err)) echo "is-invalid" ?>" type="file" id="payment" name="payment" accept="image/png, image/jpeg, image/webp">
            <div class="invalid-feedback">
              <?php echo $img_err ?>
            </div>
          </div>

          <button type="submit" id="submit" class="btn btn-primary float-end">Enviar</button>

        </form>
      </div>
    </div>
  </div>
  <!-- Content End -->


  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/js/main.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // Setup
      if ($("#name").hasClass("is-invalid")) {
        nameValid = false;
      } else {
        validateName();
      }
      if ($("#birthdate").hasClass("is-invalid")) {
        birthdateValid = false;
      } else {
        validateBirthdate();
      }
      if ($("#dni").hasClass("is-invalid")) {
        dniValid = false;
      } else {
        validateDNI();
      }
      if ($("#parent").hasClass("is-invalid")) {
        parentValid = false;
      } else {
        validateParent();
      }
      if ($("#whatsapp").hasClass("is-invalid")) {
        whatsappValid = false;
      } else {
        validateWhatsapp();
      }
      if ($("#allergies").hasClass("is-invalid")) {
        allergiesValid = false;
      } else {
        validateAllergies();
      }
      imageValid = true;
      validate();

      // Comprobamos cuando se apriete una tecla
      $("#name").keyup(function() {
        validateName();
        validate();
      });
      $("#birthdate").change(function() {
        validateBirthdate();
        validate();
      });
      $("#dni").change(function() {
        validateDNI();
        validate();
      });
      $("#parent").keyup(function() {
        validateParent();
        validate();
      });
      $("#whatsapp").change(function() {
        validateWhatsapp();
        validate();
      });
      $("#allergies").keyup(function() {
        validateAllergies();
        validate();
      });
      $("#payment").change(function() {
        validateImage();
        validate();
      });

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

      function validateBirthdate() {
        if ($("#birthdate").val().length == 0) {
          $("#birthdate").removeClass("is-invalid");
          birthdateValid = false;
          return;
        } else if (!/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/.test($("#birthdate").val())) {
          $("#birthdate").addClass("is-invalid");
          $("#birthdate").next().html("No es una fecha");
          birthdateValid = false;
          return;
        }
        $("#birthdate").removeClass("is-invalid");
        birthdateValid = true;
      }

      function validateDNI() {
        if ($("#dni").val().length == 0) {
          $("#dni").removeClass("is-invalid");
          dniValid = false;
          return;
        } else if (!/^[0-9XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i.test($("#dni").val())) {
          $("#dni").addClass("is-invalid");
          $("#dni").next().html("No es un DNI valido");
          dniValid = false;
          return;
        }
        $("#dni").removeClass("is-invalid");
        dniValid = true;
      }

      function validateParent() {
        if ($("#parent").val().length == 0) {
          $("#parent").removeClass("is-invalid");
          parentValid = false;
          return;
        } else if ($("#parent").val().length > 200) {
          $("#parent").addClass("is-invalid");
          $("#parent").next().html("Nombre demasiado largo");
          parentValid = false;
          return;
        } else if (!/^[A-Za-zÀ-ÖØ-öø-ÿ '.-]+$/.test($("#parent").val())) {
          $("#parent").addClass("is-invalid");
          $("#parent").next().html("Caracteres no validos");
          parentValid = false;
          return;
        }
        $("#parent").removeClass("is-invalid");
        parentValid = true;
      }

      function validateWhatsapp() {
        if ($("#whatsapp").val().length == 0) {
          $("#whatsapp").removeClass("is-invalid");
          whatsappValid = false;
          return;
        } else if (!/^(6|7)([0-9]){2}[ -]?(([0-9]){2}[ -]?([0-9]){2}[ -]?([0-9]){2}|([0-9]){3}[ -]?([0-9]){3})$/.test($("#whatsapp").val())) {
          $("#whatsapp").addClass("is-invalid");
          $("#whatsapp").next().html("Introduce un número de whatsapp valido");
          whatsappValid = false;
          return;
        }
        $("#whatsapp").removeClass("is-invalid");
        whatsappValid = true;
      }

      function validateAllergies() {
        if ($("#allergies").val().length == 0) {
          $("#allergies").removeClass("is-invalid");
          allergiesValid = true;
          return;
        } else if ($("#allergies").val().length > 200) {
          $("#allergies").addClass("is-invalid");
          $("#allergies").next().html("Has superado 200 caracteres");
          allergiesValid = false;
          return;
        }
        $("#allergies").removeClass("is-invalid");
        allergiesValid = true;
      }

      function validateImage() {
        file = $("#payment")[0].files[0];
        if (!/^.*\.(JPG|JPEG|PNG|WEBP)$/i.test(file.name)) {
          $("#payment").addClass("is-invalid");
          $("#payment").next().html("Solo archivos .jpeg, .jpg, .png o .webp");
          imageValid = false;
          return;
        } else if (file.type != "image/jpeg" && file.type != "image/png" && file.type != "image/webp") {
          $("#payment").addClass("is-invalid");
          $("#payment").next().html("Hay un error en la imagen");
          imageValid = false;
          return;
        } else if (file.size > 20000000) {
          $("#payment").addClass("is-invalid");
          $("#payment").next().html("La imagen supera el tamaño limite de 20MB");
          imageValid = false;
          return;
        }
        $("#payment").removeClass("is-invalid");
        imageValid = true;
      }

      function validate() {
        if (nameValid && birthdateValid && dniValid && parentValid && whatsappValid && allergiesValid && imageValid) {
          $("#submit").prop("disabled", false);
        } else {
          $("#submit").prop("disabled", true);
        }
      }
    });
  </script>
</body>

</html>