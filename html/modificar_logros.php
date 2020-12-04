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
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Palmarés", "Modificar o eliminar logros del club");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="palmares-content">
    <div class="trophy-container">
      <div class="trophy">
        <div class="trophy-img">
          <div class="trophy-img-wrapper">
            <img src="/assets/51BZ72JzaTL._AC_SX466_.jpg" />
            <a href="modificar_logro.php">
              <img src="/assets/edit-icon.PNG" class="edit-img" />
            </a>
            <img src="/assets/bin-icon.PNG" class="bin-img" />
          </div>
        </div>
        <div class="trophy-text">
          <h3>Nombre del trofeo</h3>
          <p>
            Descripción del trofeo del trofeo del trofeo del trofeo del trofeo
            del trofeo del trofeo del trofeo del trofeo
          </p>
        </div>
      </div>

      <div class="trophy">
        <div class="trophy-img">
          <div class="trophy-img-wrapper">
            <img src="/assets/trofeo-dorado-realista-espacio-texto_48799-1062.jpg" />
            <a href="modificar_logro.php">
              <img src="/assets/edit-icon.PNG" class="edit-img" />
            </a>
            <img src="/assets/bin-icon.PNG" class="bin-img" />
          </div>
        </div>
        <div class="trophy-text">
          <h3>Nombre del trofeo</h3>
          <p>
            Descripción del trofeo del trofeo del trofeo del trofeo del trofeo
            del trofeo del trofeo del trofeo del trofeo
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Content End -->

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>