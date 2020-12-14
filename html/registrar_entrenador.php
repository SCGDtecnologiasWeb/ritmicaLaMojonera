<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include($_SERVER['DOCUMENT_ROOT'] . '/php/funciones.php');

  //Parseamos las variables
  $correo = filtrado($_POST["email"]);
  $contraseña = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $nombre = filtrado($_POST["name"]);
  $dni = filtrado($_POST["dni"]);
  $telefono = filtrado($_POST["whatsapp"]);
  if (isset($_POST["escuela"])) {
    $grupos["escuela"] = 1;
  }
  if (isset($_POST["federada"])) {
    $grupos["federada"] = 1;
  }

  $img_err = "";
  $email_err = "";

  // Comprobamos que la imagen es valida
  if (file_exists($_FILES["perfil"]["tmp_name"])) {
    $img = $_FILES["perfil"];
    $img_err = validar_imagen($img);
  }

  //Conectamos a la base de datos
  require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  // Comprobamos que el email no esta siendo usado por otro usuario
  $sql_check_email = "SELECT `idEntrenador` FROM `Entrenador` WHERE `correoEntrenador` = (?)";
  $stmt = mysqli_prepare($link, $sql_check_email);
  mysqli_stmt_bind_param($stmt, "s", $correo);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  if (mysqli_stmt_num_rows($stmt) >= 1) {
    $email_err = "Este correo ya existe";
  }
  mysqli_stmt_close($stmt);

  // Si no hay errores continueamos con el registro del entrenador
  if (empty($img_err) && empty($email_err)) {

    // Insertamos el entrenador
    $sql_insert = "INSERT INTO `Entrenador` (`correoEntrenador`, `nombreCompleto`, `claveAcceso`, `DNI`, `telefono`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql_insert);
    mysqli_stmt_bind_param($stmt, "sssss", $correo, $nombre, $contraseña, $dni, $telefono);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Consultamos el id del entrenador
    $sql_get_id = "SELECT `idEntrenador` FROM `Entrenador` ORDER BY `idEntrenador` DESC LIMIT 1";
    $resultado = mysqli_query($link, $sql_get_id);
    $fila = mysqli_fetch_assoc($resultado);
    $id_entrenador = $fila["idEntrenador"];

    // Añadimos las relaciones con la tabla de grupos
    if ($grupos["escuela"] === 1) {
      // Consultamos el id de escuela
      $sql_get_id = "SELECT `idGrupo` FROM `Grupo` WHERE `nombre` = 'Escuela'";
      $resultado = mysqli_query($link, $sql_get_id);
      $fila = mysqli_fetch_assoc($resultado);
      $id_escuela = $fila["idGrupo"];

      // Añadimos una fila a la tabla que relaciona grupos y entrenadores
      $sql_insert = "INSERT INTO `Grupo_has_entrenador` (`idGrupo`, `Entrenador_idEntrenador`) VALUES ({$id_escuela}, {$id_entrenador})";
      mysqli_query($link, $sql_insert);
    }
    if ($grupos["federada"] === 1) {
      // Consultamos el id de federada  
      $sql_get_id = "SELECT `idGrupo` FROM `Grupo` WHERE `nombre` = 'Federada'";
      $resultado = mysqli_query($link, $sql_get_id);
      $fila = mysqli_fetch_assoc($resultado);
      $id_federada = $fila["idGrupo"];

      // Añadimos una fila a la tabla que relaciona grupos y entrenadores
      $sql_insert = "INSERT INTO `Grupo_has_entrenador` (`idGrupo`, `Entrenador_idEntrenador`) VALUES ({$id_federada}, {$id_entrenador})";
      mysqli_query($link, $sql_insert);
    }

    // Guardamos la imagen
    $img_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/entrenadores/entrenador" . $id_entrenador . ".jpg";
    if (isset($img)) {
      $img_src = $img["tmp_name"];
      move_uploaded_file($img_src, $img_path);
    } else {
      $img_src = $_SERVER['DOCUMENT_ROOT'] . "/assets/entrenadores/entrenador_generico.jpg";
      copy($img_src, $img_path);
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
  <title>Registrar entrenador</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/registrar_entrenador.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Usuarios", "Registrar entrenador");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Registrar nuevo entrenador</h1>
      <div class="form-container">
        <form action="/html/registrar_entrenador.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="email" class="form-label">Correo electronico *</label>
            <input type="email" class="form-control <?php if (empty(!$email_err)) echo "is-invalid" ?>" id="email" name="email" pattern="([a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,})" required value="<?php echo $correo ?>">
            <div class="invalid-feedback">
              <?php echo $email_err ?>
            </div>
          </div>

          <div class=" mb-3">
            <label for="password" class="form-label">Contraseña *</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="name" name="name" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,96}" value="<?php echo $nombre ?>">
          </div>

          <div class="mb-3">
            <label for="dni" class="form-label">DNI/NIE</label>
            <input type="text" class="form-control" id="dni" name="dni" autocomplete="off" pattern="((([x-zX-Z])|([lmLM])|[0-9]){1}([ ]?)(([0-9]){7})([-]?)([a-zA-Z]{1}))" minlength="9" maxlength="11" value="<?php echo $dni ?>">
          </div>


          <label for="whatsapp" class="form-label">Teléfono (Whatsapp)</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="prefijo-tlf">+34</span>
            <input type="text" class="form-control" id="whatsapp" name="whatsapp" autocomplete="off" pattern="(((([6]{1})([0-9]{2}))|(([7]{1})([1-4]{1})([0-9]{1})))([ ]?)((([0-9]{2})([ ]?)([0-9]{2})([ ]?)([0-9]{2}))|(([0-9]{3})([ ]?)([0-9]{3}))))" value="<?php echo $telefono ?>">
          </div>

          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="escuela" name="escuela" <?php if ($grupos["escuela"] === 1) echo "checked"; ?>>
              <label class="form-check-label" for="escuela">Escuela</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="federada" name="federada" <?php if ($grupos["federada"] === 1) echo "checked"; ?>>
              <label class="form-check-label" for="federada">Federada</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="perfil" class="form-label">Foto perfil</label>
            <input class="form-control <?php if (empty(!$img_err)) echo "is-invalid" ?>" type="file" id="perfil" name="perfil" autocomplete="off" accept="image/*">
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
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  <script src="/js/main.js"></script>
</body>

</html>