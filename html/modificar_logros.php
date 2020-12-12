<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar o eliminar logros</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/modificar_logros.css" />
</head>

<body>
  <?php
  // Comienza la sesión
  session_start();

  if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && $_SESSION["tipo_usuario"] === "administrador") {
    echo "<p style='float: right'>";
    print_r($_SESSION);
    echo "</p>";
  } else {
    header("location: /html/login.php");
  }
  ?>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Palmarés", "Modificar o eliminar logros del club");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="palmares-content">
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
                  <div class=\"trophy-img-wrapper\">
                    <img src=\"/assets/palmares/victoria{$fila["idVictoria"]}.jpg\" />
                    <a href=\"modificar_logro.php?idVictoria={$fila["idVictoria"]} \">
                      <img src=\"/assets/edit-icon.PNG\" class=\"edit-img\" />
                    </a>
                    <a href=\"/php/eliminar_logro.php?idVictoria={$fila["idVictoria"]} \">
                      <img src=\"/assets/bin-icon.PNG\" class=\"bin-img\" />
                    </a>
                  </div>
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

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>