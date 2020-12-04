<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>El club</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/el_club.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "El club");
  $links = array("/html/index.php", "/html/el_club.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Club de Gimnasia Rítmica la Mojonera</h1>
    <p>
      En el club deportivo Gimnasia Rítmica La Mojonera formamos gimnastas de
      todos los niveles y categorías. Desarrollamos nuestras actividades de
      entrenamiento en las instalaciones municipales ”Carpa de usos multíples”
      de La Mojonera (Almería), siendo el único club de gimnasia rítmica de
      este municipio.
    </p>
    <p>
      Las integrantes de nuestro club cuentan en su palmarés con medallas de
      oro, plata y bronce en diversos campeonatos provinciales y autonómicos.
      En 2020 las gimnastas Laura Gil y Milagros Casado fueron las primeras en
      participar en un Campeonato Nacional Aboluto, desde el 2017, año de
      formación del club.
    </p>
    <br />
    <img src="/assets/original/gimt (1)2.jpeg" class="normal-img" />
    <p>
      En la actualidad contamos con más de 50 gimnastas que, divididas entre
      las secciones de escuela y club, aprenden y evolucionan para participar
      en competiciones a todos los niveles. En la sección escuela da comienzo
      su primera formación. Desde los tres años adquieren habilidades no sólo
      técnicas para poder avanzar en la gimnasia rítmica, sino también de
      compañerismo y respeto hacia sus compañeras, entrenadoras y material. Su
      participación en competiciones va desde los sencillos encuentros
      Deportivos hasta los Campeonatos Provinciales, de mayor categoría,
      pasando por los trofeos y exhibiciones a los que es invitado el club.
      Aunque en la sección escuela se fomenta más el aspecto recreativo, ésta
      es nuestro pilar más importante, ya que aquí se empiezan a formar las
      gimnastas que más adelante nos representarán en los más altos niveles.
    </p>
    <p>
      Aquellas alumnas que demuestran más habilidades son propuestas por las
      entrenadoras para el siguiente escalón. A nivel de club, continúan
      adquiriendo conocimientos y aumentando su rendimiento competitivo,
      dándoles acceso a los Campeonatos Autonómicos y Nacionales, ya como
      gimnastas federadas
    </p>
    <br />

    <p>
      Todo ello no sería posible sin un buen equipo técnico, formado por
      entrenadoras especialmente cualificadas y acreditadas, algunas
      procedentes de la alta competición a nivel nacional. Como complemento
      imprescindible contamos también con un profesor especializado en la
      disciplina de Ballet.
    </p>
    <p>
      La conjunción de estos elementos, sin olvidar el trabajo y sacrificio de
      los padres, nos convierte en un gran club.
    </p>
  </div>
  <hr />
  <!-- Content End -->

  <!-- Sections Start -->
  <div class="sections-container">
    <div>
      <a href="/html/cuerpo_tecnico.html">
        <img src="/assets/cuerpoTecnico.jpeg" />
        <h2>Cuerpo técnico</h2>
      </a>
    </div>
    <div>
      <a href="/html/palmares.html">
        <img src="/assets/Más fotos/WhatsApp Image 2020-11-08 at 11.45.21 (1).jpeg" />
        <h2>Palmarés</h2>
      </a>
    </div>
  </div>
  <!-- Sections End -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>