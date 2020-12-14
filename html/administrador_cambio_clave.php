<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cambio contraseña</title>

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/administrador.css" />
    <link rel="stylesheet" href="/css/registrar_gimnasta.css" />
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

    $crumbs = array("Usuarios", "Registrar gimnasta");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

    include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
    ?>

    <!-- Content Start -->
    <div class="main">
    <div class="content-container">
      <h1>Cambiar contraseña</h1>
      <div class="form-container">
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="form-field">
            <label for="old" class="field-title">Contraseña actual</label><br />
            <input type="password" id="old" name="old" autocomplete="off" ><br />
          </div>

          <div class="form-field">
            <label for="new" class="field-title">Nueva contraseña</label><br />
            <input class="newPass" type="password" id="new" name="new" autocomplete="off"><br />
          </div>

          <div class="form-field">
            <label for="confirm" class="field-title">Confirmar contraseña</label><br />
            <input class="newPass" type="password" id="confirm" name="confirm" autocomplete="off"><br />
          </div>

          <div class="alertChangePass" style="display: none;">
          </div>
          
          <input type="submit" value="Enviar" />

        </form>
      </div>
    </div>
  </div>
    <!--Content End-->


    <!--JQuery-->
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="/js/main.js"></script>
</body>

</html>