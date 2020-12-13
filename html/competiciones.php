<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Competiciones</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/competiciones.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Competiciones");
  $links = array("/html/index.php", "/html/competiciones.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <div class="image-container">
      <a href="/html/provincial.php">
        <img src="/assets/Más fotos/provincial.jpeg" alt="Competición provincial" />
        <h3>Provincial</h3>
      </a>
    </div>
    <div class="image-container">
      <a href="/html/autonomica.php">
        <img src="/assets/Más fotos/autonomica.jpeg" alt="Competición autonómica" />
        <h3>Autonómica</h3>
      </a>
    </div>
    <div class="image-container">
      <a href="/html/nacional.php">
        <img src="/assets/Más fotos/nacional.jpeg" alt="Competición nacional" />
        <h3>Nacional</h3>
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