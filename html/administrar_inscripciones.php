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
  <title>Inscripciones</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/administrar_inscripciones.css" />
</head>

<body>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Usuarios", "Inscripciones");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

    $consulta_SQL = "SELECT `dni`, `nombreCompleto`, `fechaNacimiento`, `nombreTutor`, `telefono`, `nivel`, `consentimientoFotos`, `alergias`, `pago`, `registrado`, `Grupo_idGrupo` FROM `Gimnasta` WHERE `registrado` = 0";
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
      echo        "<p class=\"hidden-content hidden\">Pago realizado: {$fila["pago"]} ";
      if ($fila["pago"] === "Si") {
        echo          "<a href=\"/assets/matriculaciones/{$fila["dni"]}.jpg\">";
        echo            "<i class=\"fas fa-external-link-square-alt\"></i>";
        echo          "</a>";
      }
      echo        "</p>";
      echo      "</div>";
      echo      "<div class=\"contact-container\">";
      echo        "<p>Tutor/a legal: {$fila["nombreTutor"]}</p>";
      echo        "<p>Teléfono de contacto: {$fila["telefono"]}</p>";
      echo        "<p class=\"hidden-content hidden\">Alergias: {$fila["alergias"]}</p>";
      echo        "<p class=\"hidden-content hidden\">DNI: {$fila["dni"]}</p>";
      echo        "<p class=\"hidden-content hidden\">Fecha de nacimiento: {$fila["fechaNacimiento"]}</p>";
      echo      "</div>";
      echo    "</div>";
      echo    "<a href=\"/php/aceptar_inscripcion.php?idGimnasta={$fila["dni"]}\">";
      echo      "<img src=\"/assets/tick.webp\" class=\"edit-img\" alt=\"Editar\">";
      echo    "</a>";
      echo    "<a href=\"/php/rechazar_inscripcion.php?idGimnasta={$fila["dni"]}\">";
      echo      "<img src=\"/assets/cross.jpg\" class=\"bin-img\" alt=\"Eliminar\">";
      echo    "</a>";
      echo  "</div>";
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