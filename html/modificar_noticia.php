<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar noticia</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/modificar_noticia.css" />
</head>

<body>
  <?php
  // Comienza la sesión
  session_start();

  if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && $_SESSION["tipo_usuario"] === "administrador") {
    echo "<p style='float: right'>";
    print_r($_SESSION);
    echo "</p>";
  } else {
    header("location: /html/login.php");
  }
  ?>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Noticias", "Modificar noticia");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Modificar noticia</h1>
      <div class="form-container">
        <form action="#" method="POST">

          <div class="form-field">
            <label for="news-title" class="field-title">Titulo</label><br />
            <input type="text" id="news-title" name="news-title" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <label for="news-image" class="field-title">Imagen</label><br />
            <input type="file" id="news-image" name="news-image" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <label for="news-date" class="field-title">Fecha</label><br />
            <input type="date" id="news-date" name="news-date" autocomplete="off" /><br />
          </div>

          <label for="news-description" class="field-title">Descripción</label><br />
          <textarea name="news-description" id="news-description" autocomplete="off"></textarea>

          <label for="news-body" class="field-title">Cuerpo</label><br />
          <textarea name="news-body" id="news-body" autocomplete="off"></textarea>

          <input type="submit" value="Enviar" />
      </div>
      </form>
    </div>
  </div>
  <!-- Content End -->



  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>