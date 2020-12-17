<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
  header("location: /html/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eliminar imágenes</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/modificar_imagenes.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Galería", "Añadir nueva imagen");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-27\ at\ 15.39.06.jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/provincial1.jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-27\ at\ 15.39.12.jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.13\ \(1\).jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.17.jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.20.jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.23\ \(1\).jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/autonomica.jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-11-08\ at\ 11.45.21\ \(1\).jpeg');
        ">
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
  </div>
  <!-- Content End -->

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>