<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
  header("location: /html/login.php");
  exit;
}
?>

<?php
$titulo = "";
$desc = "";

$title_err = "";
$desc_err = "";
$img_err = "";

$getLogroCorrecto = 0;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  $sql_get_logro = "SELECT `tituloVictoria`, `descripcion` FROM `Victoria` WHERE `idVictoria` = (?)";
  $stmt = mysqli_prepare($link, $sql_get_logro);
  mysqli_stmt_bind_param($stmt, "s", $_GET["idVictoria"]);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  if (mysqli_stmt_num_rows($stmt) == 1) {
    mysqli_stmt_bind_result($stmt, $titulo, $desc);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($link);
} else {
  include($_SERVER['DOCUMENT_ROOT'] . '/php/funciones.php');

  //Parseamos las variables
  $titulo = filtrado($_POST["trophy-title"]);
  $desc = filtrado($_POST["trophy-description"]);

  // Errores en el titulo
  if (strlen($titulo) === 0) {
    $title_err .= "No has introducido un titulo<br>";
  }
  if (strlen($titulo) > 125) {
    $title_err .= "Titulo demasiado largo<br>";
  }

  // Errores en la descripcion
  if (strlen($desc) === 0) {
    $desc_err .= "No has introducido una descripción<br>";
  }
  if (strlen($desc) > 250) {
    $desc_err .= "Descripción demasiado larga<br>";
  }

  // Comprobamos que la imagen es valida
  if (file_exists($_FILES["trophy-image"]["tmp_name"])) {
    $img = $_FILES["trophy-image"];
    $img_err = validar_imagen($img);
  }

  if (empty($title_err) && empty($desc_err) && empty($img_err)) {
    // Conectamos a la base de datos
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

    // Actualizamos el logro
    $sql_update = "UPDATE `Victoria` SET `tituloVictoria` = (?), `descripcion` = (?) WHERE idVictoria = (?)";
    $stmt = mysqli_prepare($link, $sql_update);
    mysqli_stmt_bind_param($stmt, "ssi", $titulo, $desc, $_GET["idVictoria"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Guardamos la imagen
    if (isset($img)) {
      $img_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/palmares/victoria" . $_GET["idVictoria"] . ".jpg";
      $img_src = $img["tmp_name"];
      move_uploaded_file($img_src, $img_path);
    }

    // Cerramos la conexion
    mysqli_close($link);
    header("location: /html/modificar_logros.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar trofeo</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/modificar_logro.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Palmarés", "Modificar logro");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>


  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Modificar trofeo</h1>
      <div class="form-container">
        <form action="/html/modificar_logro.php?idVictoria=<?php echo $_GET["idVictoria"]; ?>" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="trophy-title" class="form-label">Titulo</label>
            <input class="form-control <?php if (!empty($title_err)) echo "is-invalid" ?>" type="text" id="trophy-title" name="trophy-title" required value="<?php echo $titulo ?>" required>
            <div class="invalid-feedback">
              <?php echo $title_err ?>
            </div>
          </div>


          <div class="mb-3">
            <label for="trophy-image" class="form-label">Imagen</label>
            <input class="form-control <?php if (!empty($img_err)) echo "is-invalid" ?>" type="file" id="trophy-image" name="trophy-image" accept="image/png, image/jpeg">
            <div class="invalid-feedback">
              <?php echo $img_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="trophy-description" class="form-label">Descripción</label>
            <textarea class="form-control <?php if (!empty($desc_err)) echo "is-invalid" ?>" id="trophy-description" name="trophy-description" required style="height: 90px;"><?php echo $desc ?></textarea>
            <div class="invalid-feedback">
              <?php echo $desc_err ?>
            </div>
          </div>

          <button type="submit" class="btn btn-primary float-end" id="submit">Enviar</button>

        </form>
      </div>
    </div>
  </div>
  <!-- Content End -->


  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/js/main.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // Setup
      if ($("#trophy-title").hasClass("is-invalid")) {
        titleValid = false;
      } else {
        validateTitle();
      }
      if ($("#trophy-description").hasClass("is-invalid")) {
        descriptionValid = false;
      } else {
        validateDescription();
      }
      imageValid = true;
      validate();

      // Comprobamos cuando se apriete una tecla
      $("#trophy-title").keyup(function() {
        validateTitle();
        validate();
      });
      $("#trophy-description").keyup(function() {
        validateDescription();
        validate();
      });
      $("#trophy-image").change(function() {
        validateImage();
        validate();
      });

      function validateTitle() {
        if ($("#trophy-title").val().length == 0) {
          $("#trophy-title").removeClass("is-invalid");
          titleValid = false;
          return;
        } else if ($("#trophy-title").val().length > 125) {
          $("#trophy-title").addClass("is-invalid");
          $("#trophy-title").next().html("Titulo demasiado largo");
          titleValid = false;
          return;
        }
        $("#trophy-title").removeClass("is-invalid");
        titleValid = true;
      }

      function validateDescription() {
        if ($("#trophy-description").val().length == 0) {
          $("#trophy-description").removeClass("is-invalid");
          descriptionValid = false;
          return;
        } else if ($("#trophy-description").val().length > 250) {
          $("#trophy-description").addClass("is-invalid");
          $("#trophy-description").next().html("Descripción demasiado larga");
          descriptionValid = false;
          return;
        }
        $("#trophy-description").removeClass("is-invalid");
        descriptionValid = true;
      }

      function validateImage() {
        file = $("#trophy-image")[0].files[0];
        if (!/^.*\.(JPG|JPEG|PNG)$/i.test(file.name)) {
          $("#trophy-image").addClass("is-invalid");
          $("#trophy-image").next().html("Solo archivos .jpeg, .jpg o .png");
          imageValid = false;
          return;
        } else if (file.type != "image/jpeg" && file.type != "image/png") {
          $("#trophy-image").addClass("is-invalid");
          $("#trophy-image").next().html("No es una imagen");
          imageValid = false;
          return;
        } else if (file.size > 500000) {
          $("#trophy-image").addClass("is-invalid");
          $("#trophy-image").next().html("Supera el limite de 500kB");
          imageValid = false;
          return;
        }
        $("#trophy-image").removeClass("is-invalid");
        imageValid = true;
      }

      function validate() {
        if (titleValid && descriptionValid && imageValid) {
          $("#submit").prop("disabled", false);
        } else {
          $("#submit").prop("disabled", true);
        }
      }
    });
  </script>
</body>

</html>