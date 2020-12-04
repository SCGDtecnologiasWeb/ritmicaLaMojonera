<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Federadas</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/federadas.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Actividades", "Federadas");
  $links = array("/html/index.php", "/html/actividades.php", "/html/federadas.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Grupo de Federadas de Gimnasia Rítmica La Mojonera</h1>
    <p>
      Los grupos de federadas se dividen en niveles, teniendo cada grupo un
      horario específico puesto por la coordinadora técnica. A estas gimnastas
      se le entrena con el objetivo de participar y competir en torneos a
      nivel autonómico y nacional, dependiendo del nivel de las gimnastas.
      Todas ellas han pasado previviamente por el nivel de escuela y sea
      dentro de nuestro club o vengan de otro club externo.
    </p>
    <p>
      Este nivel exige mucho sacrificio para las gimnastas pues es un nivel de
      exigencia y trabajo superior y requiere mucha constancia para mejorar
      tanto aspectos técnicos como físicos, pero sin olvidar los valores
      importantes de cualquier deporte como son el compañerismo, el trabajo en
      equipo, etc.
    </p>
    <img src="/assets/federadas.jpeg" />
  </div>
  <br />
  <!-- Content End -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>