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
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Noticias");
  $links = array("/html/index.php", "/html/noticias.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- News Start -->
  <div class="container news-container">
    <h1>Últimas Noticias</h1>
    <div class="news-row">
      <div class="news-col">
        <div class="img-wrap">
          <img src="/assets/noticia.jpg" class="news-image" />
        </div>
        <div class="news-text">
          <h5>10 octubre 2020</h5>
          <h3>Entrevista con el diario D-cerca</h3>
          <p>
            Entrevistamos a Fabiana Pereyra, del Club Gimnasia Rítmica La
            Mojonera, quien nos cuenta cómo han vivido el confinamiento las
            gimnastas del club...
          </p>
          <a href="/html/noticia.html">Leer más</a>
        </div>
      </div>
      <div class="news-col">
        <div class="img-wrap">
          <img src="/assets/Más fotos/WhatsApp Image 2020-10-29 at 14.49.15 (1).jpeg" class="news-image" />
        </div>
        <div class="news-text">
          <h5>2 agosto 2020</h5>
          <h3>Protocolo Covid</h3>
          <p>
            Nuestras instalaciones son amplias y nos permiten cumplir con
            todos los protocolos texto de ejemplo texto de ejemplo texto de
            ejemplo texto de e...
          </p>
          <a href="/html/noticia.html">Leer más</a>
        </div>
      </div>
    </div>
  </div>
  <!-- News End -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>