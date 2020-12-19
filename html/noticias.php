<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Noticias</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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

  <?php
  // Noticias
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

  $consulta_SQL = "SELECT * FROM Noticia ORDER BY idNoticia DESC";
  $resultado = $link->query($consulta_SQL);

  echo "<!-- News Start -->
          <div class=\"header-container\">
            <h1>Mantente Actualizado</h1>
          </div>
          <div class=\"container news-container\">
          <div class=\"col-md-4 col-md-offset-4 demo\"> 
              <input type=\"text\" id=\"config-demo\" class=\"form-control\">  
              <i class=\"glyphicon glyphicon-calendar fa fa-calendar\"></i>  
            </div>  
            <div class=\"news-row\">";

  while ($fila = $resultado->fetch_array()) {
    echo "<div class=\"news-col\">
            <div class=\"img-wrap\">
              <img src=\"/assets/noticias/noticia{$fila["idNoticia"]}.jpg\" class=\"news-image\" alt=\"Noticia\"/>
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

  echo  "</div>
      </div>";

  $link->close();
  ?>

  <?php
  // Footer
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>