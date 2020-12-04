<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar trofeo</title>

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
      <h1>Añadir un trofeo</h1>
      <div class="form-container">
        <form action="#" method="POST">

          <div class="form-field">
            <label for="trophy-title" class="field-title">Titulo</label><br />
            <input type="text" id="trophy-title" name="trophy-title" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <label for="trophy-image" class="field-title">Imagen</label><br />
            <input type="file" id="trophy-image" name="trophy-image" autocomplete="off" /><br />
          </div>

          <label for="trophy-description" class="field-title">Descripción</label><br />
          <textarea name="trophy-description" id="trophy-description" autocomplete="off"></textarea>

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