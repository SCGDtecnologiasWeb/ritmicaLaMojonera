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
  <!-- Menu Start -->
  <div class="container">
    <!-- Header Start -->
    <div class="row header-row">
      <div class="col"></div>
      <div class="col-10 header-col">
        <a href="/html/index.html">
          <img src="/assets/logo_ritmica2.png" />
        </a>
        <div class="header-icon-wrapper">
          <a href="https://www.facebook.com/ritmicalamojonera" class="fab fa-facebook-square"></a>
          <a href="https://www.youtube.com/channel/UC1t4MldjalCTkdC2cYVgVfg" class="fab fa-youtube"></a>
          <a href="https://www.instagram.com/ritmicalamojonera/?hl=es" class="fab fa-instagram-square"></a>
          <a href="/html/login.html" class="far fa-user"></a>
        </div>
      </div>
      <div class="col"></div>
    </div>
    <!-- Header End -->

    <!-- Navbar Start -->
    <div class="row nav-row">
      <div class="col"></div>
      <div class="col-10 nav-col" id="nav-col">
        <a class="nav-btn" href="/html/index.html">Inicio</a>
        <div class="dropdown">
          <a class="nav-btn" href="/html/el_club.html">El Club</a>
          <div class="dropdown-content">
            <a href="/html/cuerpo_tecnico.html">Cuerpo técnico</a>
            <a href="/html/palmares.html">Palmarés</a>
          </div>
        </div>
        <a class="nav-btn" href="/html/normativa.html">Normativa</a>
        <div class="dropdown">
          <a class="nav-btn" href="/html/actividades.html">Actividades</a>
          <div class="dropdown-content">
            <a href="/html/actividades_verano.html">Actividades de verano</a>
            <a href="/html/escuela.html">Escuela</a>
            <a href="/html/federadas.html">Federadas</a>
          </div>
        </div>
        <a class="nav-btn" href="/html/matriculacion.html">Matriculación</a>
        <div class="dropdown">
          <a class="nav-btn" href="/html/competiciones.html">Competiciones</a>
          <div class="dropdown-content">
            <a href="/html/provincial.html">Provincial</a>
            <a href="/html/autonomica.html">Autonómica</a>
            <a href="/html/nacional.html">Nacional</a>
          </div>
        </div>
        <a class="nav-btn" href="/html/noticias.html">Noticias</a>
        <a class="nav-btn" href="/html/galeria.html">Galería</a>
        <a class="nav-btn" href="/html/contacto.html">Contacto</a>
        <a class="dropdown-icon" href="javascript:void(0)">
          <span class="fas fa-bars"></span>
        </a>
      </div>
      <div class="col"></div>
    </div>
    <!-- Navbar End -->
  </div>
  <!-- Menu End -->

  <!-- Title Start -->
  <div class="container">
    <div class="row title-row">
      <div class="col title-empty-col"></div>
      <div class="col-5 title-col">
        <div class="title-main">
          <a href="/html/noticias.html">Noticias</a>
        </div>
      </div>

      <div class="col-5 title-col">
        <div class="title-path">
          <a href="/html/index.html">Inicio</a>
          <span>/</span>
          <a href="/html/noticias.html">Noticias</a>
        </div>
      </div>
      <div class="col title-empty-col"></div>
    </div>
  </div>
  <!-- Title End -->

  <!-- News Start -->
  <div class="container news-container">
    <h1>Últimas Noticias</h1>
    <div class="news-row">
      <?php
        include_once('config.php');

        $consulta_SQL = "SELECT * FROM noticia";
        $resultado = $link->query($consulta_SQL);

        // Iteramos sobre el resultado, obteniendo cada una de las filas
        while ($fila = $resultado->fetch_array()) {
          echo  "<div class=\"news-col\">
                  <div class=\"img-wrap\">
                    <img src=\"/assets/noticias/noticia{$fila["idNoticia"]}.jpg\" class=\"news-image\" />
                  </div>
                  <div class=\"news-text\">
                    <h5>{$fila["fecha"]}</h5>
                    <h3>{$fila["titulo"]}</h3>
                    <p>
                      {$fila["descripcion"]}
                    </p>
                    <a href=\"/php/noticia.php?idNoticia={$fila["idNoticia"]}\">Leer más</a>
                  </div>
                </div>";
        }
        $link->close();
      ?>
    </div>
  </div>
  <!-- News End -->

  <!-- Footer Start -->
  <div class="container footer">
    <div class="row">
      <div class="col-4 footer-col">
        <h1>Ven a visitarnos</h1>
        <p>Concreta una cita y disfruta de nuestros entrenamientos</p>
        <p>
          <a>
            C/ Av. Europa, 143 (Carpa de usos multiples), La Mojonera-04745,
            Almería
          </a>
        </p>
      </div>
      <div class="col-4 footer-col">
        <h1>Contacta con nosotros</h1>
        <p>
          Infórmate sobres nuestros precios y horarios, siempre habrá alguien
          encantado de atenderte
        </p>
        <p>
          Correo: <a>cdrlamojonera@gmail.com</a><br />
          Telefono: <a>621 013 265</a><br />
          Whatsapp: <a>+34 621 013 265</a><br />
        </p>
      </div>
      <div class="col-4 footer-col">
        <h1>Siguenos en redes sociales</h1>
        <p>Entérate de todo al instante</p>
        <a href="https://www.facebook.com/ritmicalamojonera" class="fab fa-facebook-square"></a>
        <a href="https://www.youtube.com/channel/UC1t4MldjalCTkdC2cYVgVfg" class="fab fa-youtube"></a>
        <a href="https://www.instagram.com/ritmicalamojonera/?hl=es" class="fab fa-instagram-square"></a>
      </div>
    </div>
    <div class="row">
      <div class="col footer-copyright-col">
        <p>
          Copyright © 2020 - Ritmica la Mojonera - Todos los derechos
          reservados
        </p>
      </div>
    </div>
    <button id="goback-btn">
      <i class="fas fa-arrow-up"></i>
    </button>
  </div>
  <!-- Footer End -->

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>