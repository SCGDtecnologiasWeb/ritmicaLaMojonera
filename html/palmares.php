<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Palmarés</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/palmares.css" />
</head>

<body>
  <?php
  // Header y titulo
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "El club", "Palmarés");
  $links = array("/html/index.php", "/html/el_club.php", "/html/palmares.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="palmares-content">
    <div>
      <h2>Palmarés del Club Rítmica La Mojonera</h2>
      <p>
        Tras el entrenamiento y un duro trabajo, tanto de las gimnastas como
        de las entrenadoras, todos los esfuerzos y sacrificios se ven
        reflejados de manera positiva en los torneos en los que el club y,
        claramente, cada una de las niñas, participan. Conlleve una victoria o
        no, estos torneos nos demuestran que el buen trabajo, el esfuerzo, las
        ganas de superación y aprendizaje que realizan y adquieren día a día,
        cada miembro del club, dan sus frutos.
      </p>
      <p>
        Algunos de los ejemplos de estos frutos son los siguientes logros que
        ha conseguido el club gracias, nuevamente, a las niñas y a sus
        entrenadoras:
      </p>
    </div>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

    $consulta_SQL = "SELECT idVictoria, tituloVictoria, descripcion FROM Victoria ORDER BY idVictoria DESC";
    $resultado = $link->query($consulta_SQL);

    $num_rows = mysqli_num_rows($resultado);
    $aux = intdiv($num_rows, 2) + ($num_rows % 2);

    for ($i = 0; $i < $aux; $i++) {
      echo "<div class=\"trophy-container\">";

      $j = 0;
      while (($fila = $resultado->fetch_array()) && $j < 2) {
        echo "<div class=\"trophy\">
                <div class=\"trophy-img\">
                  <img src=\"/assets/palmares/victoria{$fila["idVictoria"]}.jpg\" />
                </div>
                <div class=\"trophy-text\">
                  <h3>{$fila["tituloVictoria"]}</h3>
                  <p>{$fila["descripcion"]}</p>
                </div>
              </div>";
        $j++;
      }
      echo "</div>";
    }

    $link->close();
    ?>
  </div>
  <!-- Content End -->

  <?php
  // Footer
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>