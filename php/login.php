<?php
$alert = '';
session_start();
if (!empty($_POST)) {
  if (empty($_POST["usuario"]) || empty($_POST["contraseña"])) {
    $alert = 'Ingrese usuario y contraseña';
  } else {

    require_once "config.php";
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
    $queryAdmin = mysqli_query($link, "SELECT * FROM Administrador WHERE correoAdmin ='$usuario'AND claveAccesoAdmin ='$contraseña'");
    $resultAdmin = mysqli_num_rows($queryAdmin);

    if ($resultAdmin($queryAdmin) == 0) {
      echo "NO ES VALIDO EL USUARIO";
    } else {
      while ($row_query = mysqli_fetch_array($queryAdmin)) {
        if ($row_query['contraseña'] == $contraseña) {
          $_SESSION['contraseña'] = $_POST['contraseña'];
          header("location: administrar_usuarios.php");
          exit;
        } else {
          $alert = 'El usuario o la contraseña son incorrectos';
          session_destroy();
        }
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar sesión</title>

  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/login.css" />
</head>

<body>
  <div class="modal-dialog">
    <div class="main-section">
      <div class="border-0 modal-content">
        <div class="col-12 user-img text-center">
          <img src="/assets/logo_ritmica.png" width="150px" height="150px" />
        </div>
        <form action="" method="POST" class="formulario">
          <h1>Iniciar sesión</h1>
          <div class="form-group" id="user-group">
            <input type="text" class="form-control" placeholder="usuario" name="usuario" />
          </div>
          <div class="form-group" id="password-group">
            <input type="password" class="form-control" placeholder="contraseña" name="contraseña" />
          </div>
          <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
          <div class="col-12 forgot" id="forgot-icon">
            <a href="#"><i class="fas fa-caret-right"></i>¿Olvidó su contraseña?</a>
          </div>

          <div class="form-group form-button text-right">
            <button type="submit" class="btn btn-primary" name="continuar">
              <i class="fas fa-arrow-right"></i> Continuar
            </button>
          </div>

          <!--  <div class="link-button text-left">
              <a class="btn btn-primary" href="index.html" role="button"
                ><i class="fas fa-arrow-left"></i> Volver atrás</a
              >
            </div> -->
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>