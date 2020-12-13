<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cuerpo técnico</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/cuerpo_tecnico.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "El club", "Cuerpo técnico");
  $links = array("/html/index.php", "/html/el_club.php", "/html/cuerpo_tecnico.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Cuerpo técnico del Club Rítmica la Mojonera</h1>
    <p>
      Nuestros entrenadores forman gimnastas en dos niveles, escuela y club,
      realizando una gran labor tanto técnica como organizativa. Muchos de
      ellos tienen una larga experiencia con este deporte, tanto de
      entrenadores como de gimnastas. Muchos de ellos se ven obligados a
      compaginar la enseñanza de este deporte con sus estudios y formación en
      otros ámbitos. Gracias a su labor y sacrificio nuestras gimnastas
      adquieren una gran formación en este deporte.
    </p>
    <br />
    <div class="image-container">
      <img src="/assets/Juanma.jpeg" alt="Entrenador Juan Manuel Férnandez Romero" />
      <h3>Juan Manuel Fernández Romero</h3>
      <p>
        Juanma actualmente entrena a los grupos de escuela. Es entranador de
        gimnasia rítmica nivel autonómico y profesor de ballet.
      </p>
    </div>

    <div class="image-container">
      <img src="/assets/sofi.png" alt="Entrenadora Sofía Nara Casado" />
      <h3>Sofía Nara Casado</h3>
      <p>
        Sofía es la coordinadora técnica del club y es entrenadora nacional y
        juez de nivel 1. Lleva, actualmente, los grupos de gimnastas
        federadas.
      </p>
    </div>
    <div class="image-container">
      <img src="/assets/mariMar.jpeg" alt="Entrenadora María del Mar García Ulloa" />
      <h3>María del Mar García Ulloa</h3>
      <p>
        María del Mar es entrenadora a nivel provincial y ha participado en
        numerosos campeonatos de España nivel absoluto, ocupando, en varias
        ocasiones, los puestos más altos.
      </p>
    </div>
    <div class="image-container">
      <img src="/assets/annie.jpeg" alt="Entrenadora Anna Tortosa" />
      <h3>Anna Tortosa</h3>
      <p>
        Annie es entrenadora a nivel provincial y junto con Juanma lleva los
        grupos de escuela.
      </p>
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