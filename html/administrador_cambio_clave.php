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

    $administrador = $_SESSION["id"];
  // Comprobamos si el campo de contraseña esta vacio
  if (empty(trim($_POST["contraseña"]))) {
    $contraseña_err = "Por favor introduce tu contraseña.";
  } else {
    $contraseña = trim($_POST["contraseña"]);
  }
  if (empty(trim($_POST["new"]))) {
    $contraseña_err = "Por favor introduce tu contraseña.";
  } else {
    $contraseña_nueva = password_hash(trim($_POST["new"]), PASSWORD_DEFAULT);
  }
  // $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);
  $contraseña_err = "";
  // preparamos consulta
  $sql = "SELECT claveAccesoAdministrador FROM Administrador WHERE idAdministrador = $administrador";
  if ($stmt = mysqli_query($link, $sql)) {
      mysqli_stmt_bind_result($stmt, $clave_acceso_administrador);
      if (mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);
          if (mysqli_stmt_fetch($stmt)) {
              if (password_verify($contraseña, $clave_acceso_administrador)) {
                $sql2 = "UPDATE Administrador SET claveAccesoAdministrador=$contraseña_nueva WHERE claveAccesoAdministrador = $clave_acceso_administrador";
                  mysqli_stmt_close($stmt);
              } else {
                  // Mensaje de error si la contraseña es incorrecta
                  if (empty($contraseña_err)) {
                      $contraseña_err = "La contraseña es incorrecta.";
                  }
              }
          }
    
          mysqli_close($link);
      } else {
          mysqli_query($link, "ROLLBACK");
          mysqli_close($link);
          header("location: /html/error.php");
          exit;
      }
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
          <label for="contraseña" class="field-title">Contraseña actual</label><br />
          <input class="oldPass" type="password" id="oldPass" name="oldPass" placeholder="Contraseña actual" autocomplete="off"><br />
          </div>

          <div class="form-field">
            <label for="new" class="field-title">Nueva contraseña</label><br />
            <input class="newPass" type="password" id="new" name="new" placeholder="Nueva contraseña" autocomplete="off"><br />
          </div>

          <div class="form-field">
            <label for="confirm" class="field-title">Confirmar contraseña</label><br />
            <input class="newPass" type="password" id="confirm" name="confirm" placeholder ="Confirmar contraseña" autocomplete="off"><br />
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