<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "administrador") {
  header("location: /html/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar o eliminar noticias</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/modificar_noticias.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Noticias", "Modificar o eliminar noticias");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
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
            <div class=\"news-row\">";

  while ($fila = $resultado->fetch_array()) {
    echo "<div class=\"news-col\">
            <div class=\"news-wrapper\">
              <div class=\"img-wrap\">
                <img src=\"/assets/noticias/noticia{$fila["idNoticia"]}.jpg\" class=\"news-image\" alt=\"Noticia\"/>
              </div>
              <div class=\"news-text\">
              <h3>{$fila["titulo"]}</h3>
              <p>
              {$fila["descripcion"]}
              </p>
              <a href=\"/html/noticia.php?idNoticia={$fila["idNoticia"]}\">Leer más</a>
              </div>
              </div>
              <a href=\"modificar_noticia.php?idNoticia={$fila["idNoticia"]}\">
              <img src=\"/assets/edit-icon.PNG\" class=\"edit-img\"alt=\"Editar\" />
              </a>
              <a href=\"/php/eliminar_noticia.php?idNoticia={$fila["idNoticia"]}\">
              <img src=\"/assets/bin-icon.PNG\" class=\"bin-img\"alt=\"Eliminar\" />
              </a>
              </div>";
    // <h5>{$fila["fecha"]}</h5>
  }

  echo  "</div>
       </div>";

  $link->close();
  ?>

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>