<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Actividades de verano</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/actividades_verano.css" />
</head>

<body>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Actividades", "Actividades de verano");
  $links = array("/html/index.php", "/html/actividades.php", "/html/actividades_verano.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Actividades de verano de Gimnasia Rítmica La Mojonera</h1>
    <h2>Campus de verano</h2>
    <p>
      El club de Gimnasia Rítmica de La Mojonera realiza un campus deportivo
      de verano durante el mes de Agosto en el pabellón municipal de deportes
      de esta localidad en horario de mañana. En este campus e realizan
      diferentes actividades como clases de automaquillaje, zumba, baile
      moderno, preparación física, técnica corporal, técnica de aparato y
      ballet. Es apto para todos los niveles e incluso para tener un primer
      contacto con este deporte. (Proximamente tendremos novedades de la
      realización del campus de este año, estén atentos a nuestras redes
      sociales).
    </p>
    <img src="/assets/actividades_verano.jpeg" />
  </div>
  <br />
  <!-- Content End -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>