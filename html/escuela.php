<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Escuela</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/escuela.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Actividades", "Escuela");
  $links = array("/html/index.php", "/html/actividades.php", "/html/escuela.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Escuela de Gimnasia Rítmica La Mojonera</h1>
    <div class="image-container">
      <img src="/assets/Escuela.jpeg" alt="Escuela de Ritmica La Mojonera" />
      <p>
        Los grupos de escuela se dividen en función de las edades de las
        gimnastas, teniendo cada grupo un horario y un día programado. A este
        nivel se buscar desarrollar la flexibilidad necesaria para realizar los
        ejercicios adecuados para una calificación buena en los torneos y de
        esta forma poder progresar y subir de niveles.
      </p>
      <p>
        Aquellas gimnastas que muestran suficiente desarrollo se les propone
        subir de nivel y competir en torneos a niveles superiores para seguir
        formándolas y mejorando sus técnicas y habilidades.
      </p>

    </div>
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