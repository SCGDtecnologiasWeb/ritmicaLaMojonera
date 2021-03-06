<!-- Menu Start -->
<div class="container">
  <!-- Header Start -->
  <div class="row header-row">
    <div class="col"></div>
    <div class="col-10 header-col">
      <a href="/html/index.php">
        <img src="/assets/logo_ritmica2.png" alt="Logo Club" />
      </a>
      <div class="header-icon-wrapper">
        <a href="https://www.facebook.com/ritmicalamojonera" class="fab fa-facebook-square">&nbsp;</a>
        <a href="https://www.youtube.com/channel/UC1t4MldjalCTkdC2cYVgVfg" class="fab fa-youtube">&nbsp;</a>
        <a href="https://www.instagram.com/ritmicalamojonera/?hl=es" class="fab fa-instagram-square">&nbsp;</a>
        <a href="/html/login.php" class="far fa-user">&nbsp;</a>
      </div>
    </div>
    <div class="col"></div>
  </div>
  <!-- Header End -->

  <!-- Navbar Start -->
  <div class="row nav-row">
    <div class="col"></div>
    <div class="col-10 nav-col" id="nav-col">
      <a class="nav-btn" href="/html/index.php">Inicio</a>
      <div class="dropdown">
        <a class="nav-btn" href="/html/el_club.php">El Club</a>
        <div class="dropdown-content">
          <a href="/html/cuerpo_tecnico.php">Cuerpo técnico</a>
          <a href="/html/palmares.php">Palmarés</a>
        </div>
      </div>
      <a class="nav-btn" href="/html/normativa.php">Normativa</a>
      <div class="dropdown">
        <a class="nav-btn" href="/html/actividades.php">Actividades</a>
        <div class="dropdown-content">
          <a href="/html/actividades_verano.php">Actividades de verano</a>
          <a href="/html/escuela.php">Escuela</a>
          <a href="/html/federadas.php">Federadas</a>
        </div>
      </div>
      <a class="nav-btn" href="/html/matriculacion.php">Matriculación</a>
      <div class="dropdown">
        <a class="nav-btn" href="/html/competiciones.php">Competiciones</a>
        <div class="dropdown-content">
          <a href="/html/provincial.php">Provincial</a>
          <a href="/html/autonomica.php">Autonómica</a>
          <a href="/html/nacional.php">Nacional</a>
        </div>
      </div>
      <a class="nav-btn" href="/html/noticias.php">Noticias</a>
      <a class="nav-btn" href="/html/galeria.php">Galería</a>
      <a class="nav-btn" href="/html/contacto.php">Contacto</a>
      <a class="dropdown-icon" href="javascript:void(0)">
        <span class="fas fa-bars"></span>
        &nbsp;
      </a>
    </div>
    <div class="col"></div>
  </div>
  <!-- Navbar End -->
</div>
<!-- Menu End -->

<script src="/js/cookies.js"></script>

<div id="barracookies">
  Usamos cookies propias y de terceros que entre otras cosas recogen datos sobre sus hábitos de navegación para realizar análisis de uso de nuestro sitio.
  <br>
  Si continúa navegando consideramos que acepta su uso.
  <a href="javascript:void(0);" onclick="var expiration = new Date(); expiration.setTime(expiration.getTime() + (60000*60*24*365)); setCookie('avisocookies','1',expiration,'/');document.getElementById('barracookies').style.display='none';"><b>OK</b></a><a href="http://www.google.com/intl/es-419/policies/technologies/types/" target="_blank"> Más información</a> | <a href="http://www.agpd.es/portalwebAGPD/canaldocumentacion/publicaciones/common/Guias/Guia_Cookies.pdf" target="_blank">Y más</a>
</div>

<!-- Gestión barra aviso cookies -->
<script type='text/javascript'>
  var comprobar = getCookie("avisocookies");
  if (comprobar == null) {
    var expiration = new Date();
    expiration.setTime(expiration.getTime() + (60000 * 60 * 24 * 10));
    setCookie("avisocookies", "1", expiration);
    document.getElementById("barracookies").style.display = "block";
  }
</script>