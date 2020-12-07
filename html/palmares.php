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

    $consulta_SQL = "SELECT * FROM victoria ORDER BY idVictoria DESC";
    $resultado = $link->query($consulta_SQL);

    echo mysqli_num_rows($resultado);

    ?>
    <div class="trophy-container">
      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/andalucia2018Cadetes.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>Cadete C campeonas de Andalucia 2018/2019</h3>
          <p>
            Nuestro conjunto Cadete C quedan primeras en el campeonato andaluz
          </p>
        </div>
      </div>

      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/6ºAndaluciaAbsoluto.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>Sextas de Andalucía Absoluto por Equipos 2018/2019</h3>
          <p>
            Milagros Casado y Lucía Gil consiguen el sexto puesto en el
            campeonato andaluz por equipos de absoluto
          </p>
        </div>
      </div>
    </div>

    <div class="trophy-container">
      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/3ºAlmeria, BenjaminEscuela.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>Terceras de Almería, Benjamín Escuela</h3>
          <p>
            Nuestro conjunto de benjamín escuela consigue el tercer puesto a
            nivel provincial
          </p>
        </div>
      </div>

      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/5ºAndaluciaCadetePrecopa.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>Quintas de Andalucía 2018/2019 Conjunto Cadete Precopa</h3>
          <p>
            Nuestro conjunto de cadete precopa consigue el quinto puesto a
            nivel autonómico en su categoría
          </p>
        </div>
      </div>
    </div>

    <div class="trophy-container">
      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/Valentina3ºAndaluciaprebenja.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>Campeona de Andalucía Prebenjamín Precopa</h3>
          <p>
            Nuestra gimnasta Valentina Daunaraviciute consigue el primer
            puesto en esta categoría
          </p>
        </div>
      </div>

      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/Tina8ºAndaluciaPrebenjaminPecopa.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>Octava de Andalucía Prebenjamín Precopa 2018/2019</h3>
          <p>
            Nuestra gimnasta Tina Zilinskaite consigue el octavo puesto en
            esta categoría
          </p>
        </div>
      </div>
    </div>

    <div class="trophy-container">
      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/3ºPromesasConjuntoCadetaC.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>
            Terceras de Andalucía 2018/2019, primera fase de promesas,
            Conjunto Cadete C
          </h3>
          <p>
            Nuestro conjunto de Cadete C consigue el tercer puesto a nivel
            autonómico en esta categoría
          </p>
        </div>
      </div>

      <div class="trophy">
        <div class="trophy-img">
          <img src="/assets/palmares/Valentina3ºAndaluciaprebenja.jpeg" />
        </div>
        <div class="trophy-text">
          <h3>Tercera de Andalucía Prebenjamín Copa</h3>
          <p>
            Nuestra gimnasta Valentina Daunaraviciute consigue el tercer
            puesto en esta categoría a nivel autonómico
          </p>
        </div>
      </div>
    </div>
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