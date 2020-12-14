<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
  header("location: /html/login.php");
  exit;
}
?>

<?php
$nombre = "";
$fechaNac = "";
$dni = "";
$tutor = "";
$telefono = "";
$nivel = "";
$alergias = "";
$consentimiento = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include($_SERVER['DOCUMENT_ROOT'] . '/php/funciones.php');

  //Parseamos las variables
  $nombre = $_POST["name"];
  $fechaNac = $_POST["birthdate"];
  $dni = $_POST["dni"];
  $tutor = $_POST["parent"];
  $telefono = $_POST["whatsapp"];
  $nivel = $_POST["level"];
  $alergias = $_POST["allergies"];
  $consentimiento = $_POST["consent"];

  if (file_exists($_FILES["payment"]["tmp_name"])) {
    $pago = "si";
  } else {
    $pago = "no";
  }

  $img_err = "";
  $dni_err = "";

  // Comprobamos que la imagen es valida
  if (file_exists($_FILES["payment"]["tmp_name"])) {
    $img = $_FILES["payment"];
    $img_err = validar_imagen($img);
  }

  //Conectamos a la base de datos
  require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  // Comprobamos que el DNI no esta siendo usado por otra gimnasta
  $sql_check_dni = "SELECT `dni` FROM `Gimnasta` WHERE `dni` = (?)";
  $stmt = mysqli_prepare($link, $sql_check_dni);
  mysqli_stmt_bind_param($stmt, "s", $dni);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  if (mysqli_stmt_num_rows($stmt) >= 1) {
    $dni_err = "Este DNI ya esta en uso";
  }
  mysqli_stmt_close($stmt);

  // Si no hay errores continueamos con el registro de la gimnasta
  if (empty($img_err) && empty($dni_err)) {

    // Obtenemos la id del grupo de la gimnasta
    $sql_get_idGrupo = "SELECT `idGrupo` FROM `Grupo` WHERE `nombre` = (?)";
    $stmt = mysqli_prepare($link, $sql_get_idGrupo);
    mysqli_stmt_bind_param($stmt, "s", $nivel);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_grupo);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Insertamos la gimnasta
    $sql_insert = "INSERT INTO `Gimnasta` (`dni`, `nombreCompleto`, `fechaNacimiento`, `nombreTutor`, `telefono`, `nivel`, `consentimientoFotos`, `alergias`, `pago`, `registrado`, `Grupo_idGrupo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?)";
    $stmt = mysqli_prepare($link, $sql_insert);
    mysqli_stmt_bind_param($stmt, "sssssssssi", $dni, $nombre, $fechaNac, $tutor, $telefono, $nivel, $consentimiento, $alergias, $pago, $id_grupo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Guardamos la imagen
    if (isset($img)) {
      $img_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/matriculaciones/" . $dni . ".jpg";
      $img_src = $img["tmp_name"];
      move_uploaded_file($img_src, $img_path);
    }
    // Cerramos la conexion
    mysqli_close($link);
    header("location: /html/administrar_usuarios.php");
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
  <title>Registrar gimnasta</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/registrar_gimnasta.css" />
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
      <h1>Registrar nueva gimnasta</h1>
      <div class="form-container">
        <form action="/html/registrar_gimnasta.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="name" name="name" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,96}" required value="<?php echo $nombre ?>">
          </div>

          <div class="mb-3">
            <label for="birthdate" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" autocomplete="off" required value="<?php echo $fechaNac ?>">
          </div>

          <div class="mb-3">
            <label for="dni" class="form-label">DNI/NIE</label>
            <input type="text" class="form-control <?php if (empty(!$dni_err)) echo "is-invalid" ?>" id="dni" name="dni" autocomplete="off" pattern="((([x-zX-Z])|([lmLM])|[0-9]){1}([ ]?)(([0-9]){7})([-]?)([a-zA-Z]{1}))" minlength="9" maxlength="11" required value="<?php echo $dni ?>">
            <div class="invalid-feedback">
              <?php echo $dni_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="parent" class="form-label">Nombre del padre, madre o tutor/a legal</label>
            <input type="text" class="form-control" id="parent" name="parent" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,96}" required value="<?php echo $tutor ?>">
          </div>

          <label for="whatsapp" class="form-label">Teléfono (Whatsapp)</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="prefijo-tlf">+34</span>
            <input type="text" class="form-control" id="whatsapp" name="whatsapp" autocomplete="off" pattern="(((([6]{1})([0-9]{2}))|(([7]{1})([1-4]{1})([0-9]{1})))([ ]?)((([0-9]{2})([ ]?)([0-9]{2})([ ]?)([0-9]{2}))|(([0-9]{3})([ ]?)([0-9]{3}))))" required value="<?php echo $telefono ?>">
          </div>

          <div class="mb-3">
            <label for="level" class="form-label">Nivel de la gimnasta</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="level" id="level-escuela" value="escuela" autocomplete="off" required <?php if ($nivel === "escuela") echo "checked" ?>>
              <label class="form-check-label" for="level-escuela">Escuela</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="level" id="level-federada" value="federada" autocomplete="off" required <?php if ($nivel === "federada") echo "checked" ?>>
              <label class="form-check-label" for="level-federada">Federada</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="allergies" class="form-labelform-label">Alergias o enfermedades (indica cuál)</label>
            <input type="text" class="form-control" id="allergies" name="allergies" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,1000}" value="<?php echo $alergias ?>">
          </div>

          <div class="mb-3">
            <label for="consent" class="form-label">Consentimiento a subir fotos en las redes sociales</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="consent" id="consent-si" value="si" autocomplete="off" required <?php if ($consentimiento === "si") echo "checked" ?>>
              <label class="form-check-label" for="consent-si">Si</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="consent" id="consent-no" value="no" autocomplete="off" required <?php if ($consentimiento === "no") echo "checked" ?>>
              <label class="form-check-label" for="consent-no">No</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="payment" class="form-label">Adjuntar justificante de pago</label>
            <input type="file" class="form-control <?php if (empty(!$img_err)) echo "is-invalid" ?>" id="payment" name="payment" autocomplete="off" accept="image/*">
            <div class="invalid-feedback">
              <?php echo $img_err ?>
            </div>
          </div>

          <button type="submit" class="btn btn-primary float-end">Enviar</button>

        </form>
      </div>
    </div>
  </div>
  <!-- Content End -->


  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>