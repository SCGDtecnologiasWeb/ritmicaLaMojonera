<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CD Ritmica la mojonera</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/noticias.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");
  ?>

  <!-- Slider Start -->
  <div class="slider">
    <div class="slides">
      <div class="slide slide-left">
        <div class="slide-text-container">
          <div class="slide-text">
            <span></span>
          </div>
        </div>
      </div>
      <div class="slide slide-main">
        <div class="slide-text-container">
          <div class="slide-text"><span>Club La Mojonera</span></div>
        </div>
      </div>
      <div class="slide slide-right">
        <div class="slide-text-container">
          <div class="slide-text"><span></span></div>
        </div>
      </div>
    </div>
    <div class="slider-btns">
      <div class="slide-btn" id="slide-btn-1"></div>
      <div class="slide-btn" id="slide-btn-2"></div>
      <div class="slide-btn" id="slide-btn-3"></div>
    </div>
  </div>
  <!-- Slider End -->

  <?php
  // Noticias
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  $consulta_SQL = "SELECT * FROM Noticia ORDER BY idNoticia DESC LIMIT 2";
  $resultado = $link->query($consulta_SQL);

  echo "<!-- News Start -->
          <div class=\"container news-container\">
            <h1 style=\"text-align:center;\">Últimas Noticias</h1>
            <div class=\"news-row\">";

  while ($fila = $resultado->fetch_array()) {
    echo "<div class=\"news-col\">
            <div class=\"img-wrap\">
              <img src=\"/assets/noticias/noticia{$fila["idNoticia"]}.jpg\" class=\"news-image\" alt=\"Noticia\"/>
            </div>
            <div class=\"news-text\">
            <h3>{$fila["titulo"]}</h3>
            <p>
            {$fila["descripcion"]}
            </p>
            <a href=\"/html/noticia.php?idNoticia={$fila["idNoticia"]}\">Leer más</a>
            </div>
            </div>";
    // <h5>{$fila["fecha"]}</h5>
  }

  echo  "</div>
      </div>";

  $link->close();
  ?>

  <!-- Callout Start -->
  <div class="container callout">
    <div class="row callout-row">
      <div class="col-12 callout-col">
        <div class="callout-text">
          <h1>Si te gusta la gimnasia rítmica esta es tu oportunidad</h1>
          <p>Contacta con nosotros y únete a nuestra familia</p>
        </div>
        <div class="callout-btn-section">
          <a href="/html/contacto.php" class="callout-btn1">Contacto</a>
          <a href="/html/matriculacion.php" class="callout-btn2">Inscríbete</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Callout End -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>