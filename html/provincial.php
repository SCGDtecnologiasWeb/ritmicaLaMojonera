<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Provincial</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/provincial.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Competiciones", "Provincial");
  $links = array("/html/index.php", "/html/competiciones.php", "/html/provincial.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Programación de competiciones provinciales</h1>
    <p>
      En el siguiente apartado mostraremos un listado de las competiciones
      provinciales en las que participa el club diferenciando entre torneos de
      individuales y conjuntos.
    </p>
    <h2>Conjuntos</h2>
    <p>Torneo organizado por el Club Diamonds de Pulpí</p>
    <p>Torneo organizado por el Club Rítmica La Mojonera en La Mojonera</p>
    <p>Torneo organizado por el Club Roquetas 2015 en Roquetas de Mar</p>
    <h2>Individual</h2>
    <p>Torneo organizado por el Club Diamonds de Pulpí</p>
    <p>Torneo organizado por el Club Rítmica La Mojonera en La Mojonera</p>
    <p>Torneo organizado por el Club Roquetas 2015 en Roquetas de Mar</p>
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