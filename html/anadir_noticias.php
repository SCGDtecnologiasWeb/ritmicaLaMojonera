<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Añadir noticias</title>

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
        <form action="/php/anadir_noticias.php" method="POST" enctype="multipart/form-data">

          <div class="form-field">
            <label for="news-title" class="field-title">Titulo</label><br />
            <input type="text" id="news-title" name="news-title" autocomplete="off" required /><br />
          </div>

          <div class="form-field">
            <label for="news-image" class="field-title">Imagen</label><br />
            <input type="file" id="news-image" name="news-image" autocomplete="off" required /><br />
          </div>

          <div class="form-field">
            <label for="news-date" class="field-title">Fecha</label><br />
            <input type="date" id="news-date" name="news-date" autocomplete="off" required /><br />
          </div>

          <label for="news-description" class="field-title">Descripción</label><br />
          <textarea name="news-description" id="news-description" autocomplete="off" required></textarea>

          <label for="news-body" class="field-title">Cuerpo</label><br />
          <textarea name="news-body" id="news-body" autocomplete="off" required></textarea>

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