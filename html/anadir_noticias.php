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
          <div class="mb-3">
            <label for="news-title" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="news-title" name="news-title" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label for="news-image" class="form-label">Imagen</label>
            <input class="form-control" type="file" id="news-image" name="news-image" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label for="news-date" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="news-date" name="news-date" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label for="news-description" class="form-label">Descripción</label>
            <textarea class="form-control" id="news-description" name="news-description" autocomplete="off" required style="height: 90px;"></textarea>
          </div>
          <div class="mb-3">
            <label for="news-body" class="form-label">Cuerpo</label>
            <textarea class="form-control" id="news-body" name="news-body" autocomplete="off" required style="height: 300px;"></textarea>
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