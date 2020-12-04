<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar o eliminar noticias</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/modificar_noticias.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Noticias", "Modificar o eliminar noticias");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- News Start -->
  <div class="container news-container">
    <h1>Últimas Noticias</h1>
    <div class="row news-row">
      <div class="col-6 news-col">
        <div class="news-wrapper">
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
            <a>Leer más</a>
          </div>
        </div>
        <a href="modificar_noticia.php">
          <img src="/assets/edit-icon.PNG" class="edit-img" />
        </a>
        <img src="/assets/bin-icon.PNG" class="bin-img" />
      </div>
      <div class="col-6 news-col">
        <div class="news-wrapper">
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
            <a>Leer más</a>
          </div>
        </div>
        <a href="modificar_noticia.php">
          <img src="/assets/edit-icon.PNG" class="edit-img" />
        </a>
        <img src="/assets/bin-icon.PNG" class="bin-img" />
      </div>
      <div class="col-6 news-col">
        <div class="news-wrapper">
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
            <a>Leer más</a>
          </div>
        </div>
        <a href="modificar_noticia.php">
          <img src="/assets/edit-icon.PNG" class="edit-img" />
        </a>
        <img src="/assets/bin-icon.PNG" class="bin-img" />
      </div>
      <div class="col-6 news-col">
        <div class="news-wrapper">
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
            <a>Leer más</a>
          </div>
        </div>
        <a href="modificar_noticia.php">
          <img src="/assets/edit-icon.PNG" class="edit-img" />
        </a>
        <img src="/assets/bin-icon.PNG" class="bin-img" />
      </div>
    </div>
  </div>
  <!-- News End -->

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>