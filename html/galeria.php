<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Galería</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/galeria.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Galería");
  $links = array("/html/index.php", "/html/galeria.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-27\ at\ 15.39.06.jpeg');
        "></div>
    <div class="img-container" style="background-image: url('/assets/Más fotos/provincial1.jpeg')"></div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-27\ at\ 15.39.12.jpeg');
        "></div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.13\ \(1\).jpeg');
        "></div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.17.jpeg');
        "></div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.20.jpeg');
        "></div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-10-29\ at\ 14.49.23\ \(1\).jpeg');
        "></div>
    <div class="img-container" style="background-image: url('/assets/Más fotos/autonomica.jpeg')"></div>
    <div class="img-container" style="
          background-image: url('/assets/Más fotos/WhatsApp\ Image\ 2020-11-08\ at\ 11.45.21\ \(1\).jpeg');
        "></div>
  </div>
  <!-- Content End -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>