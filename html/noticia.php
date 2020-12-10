<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Noticia</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/noticia.css" />
</head>

<body>
  <?php
  // Header y titulo
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Noticias");
  $links = array("/html/index.php", "/html/el_club.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <?php
  // Noticia
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  $consulta_SQL = "SELECT * FROM Noticia WHERE idNoticia = {$_GET["idNoticia"]}";
  $resultado = $link->query($consulta_SQL);
  $fila = $resultado->fetch_array();

  echo "<!-- Content Start --> <div class=\"individual-news-container\">";

  echo  "<img src=\"/assets/noticias/noticia{$fila["idNoticia"]}.jpg\">
            <p class=\"individual-news-title\">{$fila["titulo"]}</p>
            <p class=\"individual-news-description\">{$fila["descripcion"]}</p>
            <p class=\"individual-news-body\">{$fila["cuerpo"]}</p>
            <div class=\"individual-news-date\">{$fila["fecha"]}</div>";

  echo "</div> <!-- Content End -->";

  $link->close();
  ?>

  <?php
  // Footer
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>