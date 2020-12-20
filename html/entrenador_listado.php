<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["tipo_usuario"] !== "entrenador") {
  header("location: /html/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de gimnastas</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/entrenador.css" />
  <link rel="stylesheet" href="/css/entrenador_listado.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_entrenador.php");

  $crumbs = array("Grupo", "Acceso listado");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_entrenador.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_entrenador.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Gimnastas</h1>
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
    $sql_get_grupos = "SELECT `ghe`.`idGrupo`
                       FROM `Grupo_has_entrenador` `ghe` JOIN `Entrenador` `e` ON `ghe`.`Entrenador_idEntrenador` = `e`.`idEntrenador`
                       WHERE `e`.`idEntrenador` = {$_SESSION["id"]}";

    $resultado_grupos = mysqli_query($link, $sql_get_grupos);
    if (mysqli_num_rows($resultado_grupos) !== 0) {
      $grupos = "(";
      while ($fila_grupos = mysqli_fetch_assoc($resultado_grupos)) {
        $grupos .= $fila_grupos["idGrupo"] . ", ";
      }
      $grupos = substr($grupos, 0, -2);
      $grupos .= ")";

      $consulta_SQL = "SELECT `dni`, `nombreCompleto`, `fechaNacimiento`, `nombreTutor`, `telefono`, `nivel`, `consentimientoFotos`, `alergias`, `Grupo_idGrupo` FROM `Gimnasta` WHERE `registrado` = 1 AND `Grupo_idGrupo` IN {$grupos}";
      $resultado = $link->query($consulta_SQL);
      while ($fila = $resultado->fetch_array()) {
        echo  "<div class=\"gymnast-container\">";
        echo    "<div class=\"gymnast\">";
        echo      "<div class=\"img-container\">";
        echo        "<img src=\"/assets/matriculaciones/gimnasta_generico.jpg\" alt=\"Gimnasta\">";
        echo      "</div>";
        echo      "<div class=\"name-container\">";
        echo        "<h2>{$fila["nombreCompleto"]}</h2>";
        echo        "<p>Grupo: {$fila["nivel"]}</p>";
        echo        "<p class=\"hidden-content hidden\">Consentimiento a fotos: {$fila["consentimientoFotos"]}</p>";
        echo        "<p class=\"hidden-content hidden\">DNI: {$fila["dni"]}</p>";
        echo      "</div>";
        echo      "<div class=\"contact-container\">";
        echo        "<p>Tutor/a legal: {$fila["nombreTutor"]}</p>";
        echo        "<p>Teléfono de contacto: {$fila["telefono"]}</p>";
        echo        "<p class=\"hidden-content hidden\">Alergias: {$fila["alergias"]}</p>";
        echo        "<p class=\"hidden-content hidden\">Fecha de nacimiento: {$fila["fechaNacimiento"]}</p>";
        echo      "</div>";
        echo    "</div>";
        echo  "</div>";
      }
    }
    mysqli_close($link);
    ?>
  </div>
  <!-- Content End -->

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>