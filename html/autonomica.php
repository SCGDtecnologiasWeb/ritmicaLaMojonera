<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Autonómica</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/autonomica.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Competiciones", "Autonómica");
  $links = array("/html/index.php", "/html/competiciones.php", "/html/autonomica.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Programación de competiciones autonómicas</h1>
    <p>
      En el siguiente apartado mostraremos un listado de las competiciones
      autonómicas en las que participa el club diferenciando entre
      individuales y conjuntos.
    </p>
    <h2>Conjuntos</h2>
    <p>Campeonato de Andalucía de Promesas</p>
    <p>Campeonato de Andalucía de Precopa</p>
    <h2>Individual</h2>
    <p>Campeonato de Andalucía de Promesas</p>
    <p>Campeonato de Andalucía Individual</p>
    <p>Campeonato de Andalucía de Copa</p>
    <p>Campeonato de Andalucía de Precopa</p>
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