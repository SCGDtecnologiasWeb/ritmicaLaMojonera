<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
  header("location: /html/login.php");
  exit;
}
?>

<?php
$titulo = "";
$fecha = "";
$desc = "";
$cuerpo = "";

$title_err = "";
$date_err = "";
$desc_err = "";
$body_err = "";
$img_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include($_SERVER['DOCUMENT_ROOT'] . '/php/funciones.php');

  // Parseamos las variables
  $titulo = filtrado($_POST["news-title"]);
  $fecha = filtrado($_POST["news-date"]);
  $desc = filtrado($_POST["news-description"]);
  $cuerpo = filtrado($_POST["news-body"]);

  // Errores en el titulo
  if (strlen($titulo) === 0) {
    $title_err .= "No has introducido un titulo<br>";
  }
  if (strlen($titulo) > 60) {
    $title_err .= "Titulo demasiado largo<br>";
  }

  // Errores en la fecha
  if (strlen($fecha) === 0) {
    $date_err .= "No has introducido una fecha<br>";
  }
  if (!preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/', $fecha)) {
    $date_err .= "No es una fecha<br>";
  }

  // Errores en la descripcion
  if (strlen($desc) === 0) {
    $desc_err .= "No has introducido una descripción<br>";
  }
  if (strlen($desc) > 200) {
    $desc_err .= "Descripción demasiado larga<br>";
  }

  // Errores en el cuerpo
  if (strlen($cuerpo) === 0) {
    $body_err .= "No has introducido un cuerpo de la noticia<br>";
  }
  if (strlen($cuerpo) > 10000) {
    $body_err .= "Cuerpo de la noticia demasiado largo<br>";
  }

  // Comprobamos que la imagen es valida
  if (file_exists($_FILES["news-image"]["tmp_name"])) {
    $img = $_FILES["news-image"];
    $img_err = validar_imagen($img);
  }

  if (empty($title_err) && empty($date_err) && empty($desc_err) && empty($body_err) && empty($img_err)) {
    // Conectamos a la base de datos
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

    // Insertamos la noticia en la base de datos
    $sql_insert = "INSERT INTO `Noticia` (`titulo`, `descripcion`, `cuerpo`, `fecha`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql_insert);
    mysqli_stmt_bind_param($stmt, "ssss", $titulo, $desc, $cuerpo, $fecha);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Obtenemos el id de la noticia
    $sql_get_id = "SELECT `idNoticia` FROM `Noticia` ORDER BY `idNoticia` DESC LIMIT 1";
    $resultado = mysqli_query($link, $sql_get_id);
    $fila =  mysqli_fetch_assoc($resultado);
    $idNoticia = $fila['idNoticia'];

    // Guardamos la imagen
    $img_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/noticias/noticia" . $idNoticia . ".jpg";
    $img_src = $img["tmp_name"];
    move_uploaded_file($img_src, $img_path);

    // Cerramos la conexion y terminamos el proceso
    mysqli_close($link);
    echo $img_path;
    header("location: /html/modificar_noticias.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Añadir noticias</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/anadir_noticias.css" />

</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Noticias", "Añadir noticias");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Añadir una noticia</h1>
      <div class="form-container">
        <form action="/html/anadir_noticias.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="news-title" class="form-label">Titulo</label>
            <input class="form-control <?php if (!empty($title_err)) echo "is-invalid" ?>" type="text" id="news-title" name="news-title" required value="<?php echo $titulo ?>" required>
            <div class="invalid-feedback">
              <?php echo $title_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="news-image" class="form-label">Imagen</label>
            <input class="form-control <?php if (!empty($img_err)) echo "is-invalid" ?>" type="file" id="news-image" name="news-image" value="<?php echo $fecha ?>" required accept="image/png, image/jpeg">
            <div class="invalid-feedback">
              <?php echo $img_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="news-date" class="form-label">Fecha</label>
            <input class="form-control <?php if (!empty($date_err)) echo "is-invalid" ?>" type="date" id="news-date" name="news-date" value="<?php echo $fecha ?>" required>
            <div class="invalid-feedback">
              <?php echo $date_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="news-description" class="form-label">Descripción</label>
            <textarea class="form-control <?php if (!empty($desc_err)) echo "is-invalid" ?>" id="news-description" name="news-description" required style="height: 90px;"><?php echo $desc ?></textarea>
            <div class="invalid-feedback">
              <?php echo $desc_err ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="news-body" class="form-label">Cuerpo</label>
            <textarea class="form-control <?php if (!empty($body_err)) echo "is-invalid" ?>" id="news-body" name="news-body" required style="height: 300px;"><?php echo $cuerpo ?></textarea>
            <div class="invalid-feedback">
              <?php echo $body_err ?>
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
      if ($("#news-title").hasClass("is-invalid")) {
        titleValid = false;
      } else {
        validateTitle();
      }
      if ($("#news-date").hasClass("is-invalid")) {
        dateValid = false;
      } else {
        validateDate();
      }
      if ($("#news-description").hasClass("is-invalid")) {
        descriptionValid = false;
      } else {
        validateDescription();
      }
      if ($("#news-body").hasClass("is-invalid")) {
        bodyValid = false;
      } else {
        validateBody();
      }
      imageValid = false;
      validate();

      // Comprobamos cuando se apriete una tecla
      $("#news-title").keyup(function() {
        validateTitle();
        validate();
      });
      $("#news-date").change(function() {
        validateDate();
        validate();
      });
      $("#news-description").keyup(function() {
        validateDescription();
        validate();
      });
      $("#news-body").keyup(function() {
        validateBody();
        validate();
      });
      $("#news-image").change(function() {
        validateImage();
        validate();
      });

      function validateTitle() {
        if ($("#news-title").val().length == 0) {
          $("#news-title").removeClass("is-invalid");
          titleValid = false;
          return;
        } else if ($("#news-title").val().length > 60) {
          $("#news-title").addClass("is-invalid");
          $("#news-title").next().html("Titulo demasiado largo");
          titleValid = false;
          return;
        }
        $("#news-title").removeClass("is-invalid");
        titleValid = true;
      }

      function validateDate() {
        if ($("#news-date").val().length == 0) {
          $("#news-date").removeClass("is-invalid");
          dateValid = false;
          return;
        } else if (!/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/.test($("#news-date").val())) {
          $("#news-date").addClass("is-invalid");
          $("#news-date").next().html("No es una fecha");
          dateValid = false;
          return;
        }
        $("#news-date").removeClass("is-invalid");
        dateValid = true;
      }

      function validateDescription() {
        if ($("#news-description").val().length == 0) {
          $("#news-description").removeClass("is-invalid");
          descriptionValid = false;
          return;
        } else if ($("#news-description").val().length > 200) {
          $("#news-description").addClass("is-invalid");
          $("#news-description").next().html("Descripción demasiado larga");
          descriptionValid = false;
          return;
        }
        $("#news-description").removeClass("is-invalid");
        descriptionValid = true;
      }

      function validateBody() {
        if ($("#news-body").val().length == 0) {
          $("#news-body").removeClass("is-invalid");
          bodyValid = false;
          return;
        } else if ($("#news-body").val().length > 10000) {
          $("#news-body").addClass("is-invalid");
          $("#news-body").next().html("Cuerpo de la noticia demasiado largo");
          bodyValid = false;
          return;
        }
        $("#news-body").removeClass("is-invalid");
        bodyValid = true;
      }

      function validateImage() {
        file = $("#news-image")[0].files[0];
        if (!/^.*\.(JPG|JPEG|PNG)$/i.test(file.name)) {
          $("#news-image").addClass("is-invalid");
          $("#news-image").next().html("Solo archivos .jpeg, .jpg o .png");
          imageValid = false;
          return;
        } else if (file.type != "image/jpeg" && file.type != "image/png") {
          $("#news-image").addClass("is-invalid");
          $("#news-image").next().html("No es una imagen");
          imageValid = false;
          return;
        } else if (file.size > 500000) {
          $("#news-image").addClass("is-invalid");
          $("#news-image").next().html("Supera el limite de 500kB");
          imageValid = false;
          return;
        }
        $("#news-image").removeClass("is-invalid");
        imageValid = true;
      }

      function validate() {
        if (titleValid && dateValid && descriptionValid && bodyValid && imageValid) {
          $("#submit").prop("disabled", false);
        } else {
          $("#submit").prop("disabled", true);
        }
      }
    });
  </script>
</body>

</html>