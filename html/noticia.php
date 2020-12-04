<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Noticia</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/noticia.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Noticias");
  $links = array("/html/index.php", "/html/el_club.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="individual-news-container">
    <img src="/assets/noticia.jpg">
    <p class="individual-news-title">Entrevista con el diario D-cerca</p>
    <p class="individual-news-description">
      Entrevistamos a Fabiana Pereyra, del Club Gimnasia Rítmica La Mojonera, quien nos cuenta cómo han vivido el
      confinamiento las gimnastas del club y cómo están afrontando los nuevos entrenamientos cumpliendo con todas las
      medidas de seguridad.
    </p>
    <p class="individual-news-body">
      Pregunta - La temporada pasada acabó de manera bastante complicada, ya que llegó la pandemia y hubo que parar
      todo, ¿cómo se actuó desde el club y en qué momento competitivo os encontrabais?
    </p>
    <p class="individual-news-body">
      Respuesta -
      Estábamos en plena temporada competitiva, es más, el fin de semana anterior al confinamiento tuvimos una
      competición en Roquetas de Mar en el que nos fuimos con muy buen sabor de boca, consiguiendo diferentes metales en
      casi todas las categorías con las que participábamos. Desgraciadamente, llegó el confinamiento y nos vimos
      obligados a entrenar online, a través de una pantalla.
    </p>
    <p class="individual-news-body">
      P. - Durante el confinamiento no se pudo realizar nada de deporte, pero son muchos los deportistas que han
      intentado seguir haciendo ejercicio en sus casas, ¿cómo se vivió esta situación por parte de las gimnastas del
      club y qué pautas de entrenamiento se le dieron a las jóvenes para no estar tanto tiempo paradas?
    </p>
    <p class="individual-news-body">
      R. - Los primeros días del confinamiento, los técnicos del Club enviaban una programación a las gimnastas que
      tenían que seguir y enviar los vídeos para que los entrenadores los corrigieran, luego nos pasamos a entrenar
      mediante videollamada, ya que ahí se podía corregir directamente, y era mucho más motivador para ellas,
      entrenábamos casi las mismas horas que en un entrenamiento presencial. Algunos días hacíamos retos o clases de
      maquillaje, para así entretener y motivar a las gimnastas. La mayoría de deportistas siguieron todas y cada una de
      las clases durante el confinamiento.
    </p>
    <p class="individual-news-body">
      P. - Cuando se volvió a la nueva normalidad, ¿qué preparación ha llevado a cabo el club de cara a la vuelta de los
      entrenamientos y qué medidas se están tomando para que se cumpla siempre con las pautas de seguridad y distancia
      entre gimnastas?
    </p>
    <p class="individual-news-body">
      R. - Estamos siguiendo el protocolo interpuesto por nuestro Ayuntamiento y, también, el protocolo enviado por la
      Federación Andaluza de Gimnasia. Tenemos la gran suerte de contar con tres tapices y una instalación de gran
      tamaño, lo que nos facilita mantener la distancia de seguridad. A la entrada, las gimnastas se cambian el calzado
      y se ponen uno de uso exclusivo para la instalación, se les toma la temperatura y se les proporciona gel
      hidroalcohólico, siempre con mascarilla. Cada gimnasta tiene una caja de plástico que se guarda en la instalación
      con todo su material que se desinfecta todos los días antes y después de entrenar. Los tapices los desinfectamos y
      limpiamos todos los días, después de cada entrenamiento. A la salida, se vuelve a repetir el proceso, cambio de
      calzado y gel hidroalcohólico. Los padres se quedan en los coches para evitar aglomeraciones en la puerta.

    </p>
    <div class="individual-news-date">10 octubre 2020</div>
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