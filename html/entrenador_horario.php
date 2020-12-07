<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Horarios</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/entrenador.css" />
  <link rel="stylesheet" href="/css/entrenador_horario.css" />
</head>

<body>
  <?php
  // Comienza la sesión
  session_start();

  if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && $_SESSION["tipo_usuario"] === "entrenador") {
    echo "<p style='float: right'>";
    print_r($_SESSION);
    echo "</p>";
  } else {
    header("location: /html/login.php");
  }
  ?>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_entrenador.php");

  $crumbs = array("Grupo", "Acceso horarios");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_entrenador.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_entrenador.php");
  ?>

  <!-- Content Start -->
  <!-- Content End -->


  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>