<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CD Ritmica la mojonera</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
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

  <!-- News Start -->
  <div class="container news-container">
    <h1>Últimas Noticias</h1>
    <div class="row news-row">
      <div class="col-6 news-col">
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
          <a>Leer mas</a>
        </div>
      </div>
      <div class="col-6 news-col">
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
          <a>Leer mas</a>
        </div>
      </div>
    </div>
  </div>
  <!-- News End -->

  <!-- Callout Start -->
  <div class="container callout">
    <div class="row">
      <div class="col-12 callout-col">
        <h1>Si te gusta la gimnasia rítmica esta es tu oportunidad</h1>
        <p>Contacta con nosotros y únete a nuestra familia</p>
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