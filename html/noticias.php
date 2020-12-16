<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Noticias</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/noticias.css" />
</head>

<body>
  <?php
  // Header y titulo
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Noticias");
  $links = array("/html/index.php", "/html/noticias.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <?php
  // Noticias
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  $consulta_SQL = "SELECT * FROM Noticia ORDER BY idNoticia DESC";
  $resultado = $link->query($consulta_SQL);

  echo "<!-- News Start -->
          <div class=\"container news-container\">
            <h1>Manente Actualizado</h1>
            <div class=\"news-row\">";

  while ($fila = $resultado->fetch_array()) {
    echo "<div class=\"news-col\">
            <div class=\"img-wrap\">
              <img src=\"/assets/noticias/noticia{$fila["idNoticia"]}.jpg\" class=\"news-image\" alt=\"Noticia\"/>
            </div>
            <div class=\"news-text\">
              <h5>{$fila["fecha"]}</h5>
              <h3>{$fila["titulo"]}</h3>
              <p>
                {$fila["descripcion"]}
              </p>
              <a href=\"/html/noticia.php?idNoticia={$fila["idNoticia"]}\">Leer más</a>
            </div>
          </div>";
  }

  echo  "</div>
      </div>";

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