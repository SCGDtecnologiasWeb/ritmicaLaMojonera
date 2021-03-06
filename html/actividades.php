<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Actividades</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/actividades.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Actividades");
  $links = array("/html/index.php", "/html/actividades.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <div class="image-container">
      <a href="/html/actividades_verano.php">
        <img src="/assets/actividades_verano.jpeg" alt="Actividades de verano" />
        <h3>Actividades de verano</h3>
      </a>
    </div>
    <div class="image-container">
      <a href="/html/federadas.php">
        <img src="/assets/federadas.jpeg" alt="Gimnastas federadas" />
        <h3>Federadas</h3>
      </a>
    </div>
    <div class="image-container">
      <a href="/html/escuela.php">
        <img src="/assets/Escuela.jpeg" alt="Escuela de Rítmica La Mojonera" />
        <h3>Escuela</h3>
      </a>
    </div>
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