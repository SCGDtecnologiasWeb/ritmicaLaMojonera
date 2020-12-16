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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include($_SERVER['DOCUMENT_ROOT'] . '/php/funciones.php');

  //Parseamos las variables
  $titulo = filtrado($_POST["news-title"]);
  $img = $_FILES["news-image"];
  $fecha = filtrado($_POST["news-date"]);
  $desc = filtrado($_POST["news-description"]);
  $cuerpo = filtrado($_POST["news-body"]);

  $img_err = "";
  $uploadOk = 1;
  $insertCorrecto = 0;
  $moveImageCorrecto = 0;

  //Comprobamos que sea una imagen
  $check = getimagesize($img["tmp_name"]);
  if ($check !== false) {
    echo "Es una imagen de tipo " . $check["mime"] . "<br>";
  } else {
    $img_err .= "No es una imagen" . "<br>";
    $uploadOk = 0;
  }
  // Comprobar el tipo de archivo
  if ($uploadOk == 1 && $check["mime"] != "image/jpeg" && $check["mime"] != "image/png") {
    $img_err .= "Solo archivos .jpeg, .jpg o .png" . "<br>";
    $uploadOk = 0;
  }
  // Comprueba el tamaño de la imagen, limite de 500kB
  if ($img["size"] > 500000) {
    $img_err .= "Tamaño de archivo demasiado grande" . "<br>";
    $uploadOk = 0;
  }

  if ($uploadOk == 1) {
    //Conectamos a la base de datos
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

    //Creamos el código para insertar
    $sql_insert = "INSERT INTO `Noticia` (`titulo`, `descripcion`, `cuerpo`, `fecha`) VALUES (?, ?, ?, ?)";
    $sql_get_id = "SELECT idNoticia FROM `Noticia` ORDER BY idNoticia DESC LIMIT 1";

    // Preparamos la consulta
    if ($stmt = mysqli_prepare($link, $sql_insert)) {
      mysqli_stmt_bind_param($stmt, "ssss", $titulo, $desc, $cuerpo, $fecha);

      // Insertamos las noticias
      if (mysqli_stmt_execute($stmt)) {
        $insertCorrecto = 1;
      }

      mysqli_stmt_close($stmt);

      // Consultamos el id de la noticia
      $resultado = mysqli_query($link, $sql_get_id);
      $fila =  mysqli_fetch_assoc($resultado);
      $idN = $fila['idNoticia'];

      //Guardamos la imagen
      $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/noticias/";
      $nombre_archivo = "noticia" . $idN . ".jpg";
      $ruta_archivo = $directorio . $nombre_archivo;

      if (move_uploaded_file($img["tmp_name"], $ruta_archivo)) {
        $moveImageCorrecto = 1;
        echo "La imagen " . htmlspecialchars(basename($img["name"])) . " se ha subido correctamente" . "<br>";
      } else {
        echo "Ha habido un error al subir la imagen" . "<br>";
      }
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    // Cerramos la conexion
    mysqli_close($link);
  }

  if ($insertCorrecto == 1 && $moveImageCorrecto == 1) {
    header("location: /html/modificar_noticias.php");
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
            <input type="text" class="form-control" id="news-title" name="news-title" autocomplete="off" required <?php echo "value=\"" . $titulo . "\"" ?>>
          </div>
          <div class="mb-3">
            <label for="news-image" class="form-label">Imagen</label>
            <?php
            if (empty($img_err)) {
              echo "<input class=\"form-control\" type=\"file\" id=\"news-image\" name=\"news-image\" autocomplete=\"off\" required>";
            } else {
              echo "<input class=\"form-control is-invalid\" type=\"file\" id=\"news-image\" name=\"news-image\" autocomplete=\"off\" required>";
              echo "<div class=\"invalid-feedback\">";
              echo $img_err;
              echo "</div>";
            }
            ?>
          </div>
          <div class="mb-3">
            <label for="news-date" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="news-date" name="news-date" autocomplete="off" required <?php echo "value=\"" . $fecha . "\"" ?>>
          </div>
          <div class="mb-3">
            <label for="news-description" class="form-label">Descripción</label>
            <textarea class="form-control" id="news-description" name="news-description" autocomplete="off" required style="height: 90px;"><?php echo $desc ?></textarea>
          </div>
          <div class="mb-3">
            <label for="news-body" class="form-label">Cuerpo</label>
            <textarea class="form-control" id="news-body" name="news-body" autocomplete="off" required style="height: 300px;"><?php echo $cuerpo ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Content End -->

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <script src="/js/main.js"></script>
</body>

</html>