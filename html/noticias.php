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
  <?php
  // Header y titulo
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Noticias");
  $links = array("/html/index.php", "/html/noticias.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- News Start -->
  <div class="header-container">
    <h1>Mantente Actualizado</h1>
    <div class="filter-container">
      <form action="/html/noticias.php" method="POST">

        <div class="">
          <label for="fechaInicio" class="form-label">Fecha inicial:</label>
          <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" value="$fechaInicial">&nbsp
        </div>

        <div class="">
          <label for="fechaFin" class="form-label">Fecha final:</label>
          <input type="date" id="fechaFin" name="fechaFin" class="form-control" value="$fechaFinal">&nbsp
        </div>

        <div class="">
          <input type="submit" class="btn btn-primary float-end" value="Buscar"></input>
        </div>

      </form>
    </div>
  </div>

  <div class="container news-container">
    <div class="news-row">
      <?php
      // Noticias
      include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

      if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        $consulta_SQL = "SELECT * FROM Noticia ORDER BY fecha DESC";
      } else {
        if (!empty($_POST['fechaInicio'])) {
          $fechaInicial = $_POST['fechaInicio'];
        }
        if (!empty($_POST['fechaFin'])) {
          $fechaFinal = $_POST['fechaFin'];
        }
        if (isset($fechaInicial) && isset($fechaFinal)) {
          $consulta_SQL = "SELECT * FROM Noticia WHERE fecha >= '$fechaInicial' AND fecha <= '$fechaFinal' ORDER BY fecha DESC";
        } else if (isset($fechaInicial) && !isset($fechaFinal)) {
          $consulta_SQL = "SELECT * FROM Noticia WHERE fecha >= '$fechaInicial' ORDER BY fecha DESC";
        } else if (!isset($fechaInicial) && isset($fechaFinal)) {
          $consulta_SQL = "SELECT * FROM Noticia WHERE fecha <= '$fechaFinal' ORDER BY fecha DESC";
        } else {
          $consulta_SQL = "SELECT * FROM Noticia ORDER BY fecha DESC";
        }
      }
      $resultado = $link->query($consulta_SQL);


      while ($fila = $resultado->fetch_array()) {
        echo "<div class=\"news-col\">
            <div class=\"img-wrap\">
              <a href=\"/html/noticia.php?idNoticia={$fila["idNoticia"]}\">
                <img src=\"/assets/noticias/noticia{$fila["idNoticia"]}.jpg\" class=\"news-image\" alt=\"Noticia\"/>
              </a>
            </div>
            <div class=\"news-text\">
            <h3>{$fila["titulo"]}</h3>
            <h5>{$fila["fecha"]}</h5>
            <p>
            {$fila["descripcion"]}
            </p>
            <a href=\"/html/noticia.php?idNoticia={$fila["idNoticia"]}\">Leer más</a>
            </div>
            </div>";
      }


      $link->close();
      ?>
    </div>
  </div>

  <?php
  // Footer
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>