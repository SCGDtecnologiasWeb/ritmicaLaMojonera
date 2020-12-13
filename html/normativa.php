<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Normativa</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/normativa.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Normativa");
  $links = array("/html/index.php", "/html/normativa.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <div class="normative">
      <h2>Normativa Técnica 2021</h2>
      <p>
        A continuación, se mostrará una breve descripción de la normativa que
        deberá seguir para el curso 2021:
      </p>
      <div class="normative-content">
        <div class="normative-img">
          <a href="/assets/Normativas/undefined_undefined_b50791876a8b2ae86bd27b97d8f06399.pdf" target="_blank" rel="noopener noreferrer">
            <img src="/assets/Normativas/undefined_undefined_b50791876a8b2ae86bd27b97d8f06399-1-1.jpg" alt="Normativa 2021" />
          </a>
        </div>

        <div class="normative-text">
          <h3>Aspectos a destacar</h3>
          <p>
            Normativa publicada por la Real Federación Española de Gimnasia en
            el año 2021 que abarcan los niveles base y absoluto.
          </p>
          <p>
            Todos los participantes deberán ajustarse al Reglamento General de
            Competición y al Reglamento de Licencias en vigor. En caso de
            discrepancia entre lo establecido en esta Normativa Técnica y el
            Reglamento General de Competición, prevalecerá lo establecido en
            el Reglamento General de Competición vigente. En aquellos casos
            extraordinarios, no contemplados en esta Normativa Técnica, se
            aplicará lo estipulado para tal efecto en el Reglamento Técnico de
            la FIG.
          </p>
          <p>
            NOTA: En competiciones nacionales, donde el plazo de inscripción
            de los equipos (de club y/o Comunidad Autónoma) haya finalizado, y
            dicha inscripción se vea afectada por la designación de una
            gimnasta, por parte de la seleccionadora nacional, para ir a una
            competición internacional, se permitirá la sustitución de dicha
            gimnasta por otra, aun fuera del plazo establecido para las
            inscripciones.
          </p>
        </div>
      </div>
      <p></p>
    </div>

    <div class="normative">
      <h2>Normativa Técnica 2020</h2>
      <p>
        A continuación, se mostrará una breve descripción de la normativa que
        deberá seguir para el curso 2020:
      </p>
      <div class="normative-content">
        <div class="normative-img">
          <a href="/assets/Normativas/Normativa2020.pdf" target="_blank" rel="noopener noreferrer">
            <img src="/assets/Normativas/Normativa2020-1-1.jpg" alt="Normativa 2020" />
          </a>
        </div>

        <div class="normative-text">
          <h3>Aspectos a destacar</h3>
          <p>
            Normativa publicada por la Real Federación Española de Gimnasia en
            el año 2020 que abarcan los niveles base y absoluto.
          </p>
          <p>
            Todos los participantes deberán ajustarse al Reglamento General de
            Competición y al Reglamento de Licencias en vigor. En caso de
            discrepancia entre lo establecido en esta Normativa Técnica y el
            Reglamento General de Competición, prevalecerá lo establecido en
            el Reglamento General de Competición vigente. En aquellos casos
            extraordinarios, no contemplados en esta Normativa Técnica, se
            aplicará lo estipulado para tal efecto en el Reglamento Técnico de
            la FIG.
          </p>
          <p>
            NOTA: En competiciones nacionales, donde el plazo de inscripción
            de los equipos (de club y/o Comunidad Autónoma) haya finalizado, y
            dicha inscripción se vea afectada por la designación de una
            gimnasta, por parte de la seleccionadora nacional, para ir a una
            competición internacional, se permitirá la sustitución de dicha
            gimnasta por otra, aun fuera del plazo establecido para las
            inscripciones.
          </p>
        </div>
      </div>
      <p></p>
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