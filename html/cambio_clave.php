<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cambio contraseña</title>

  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

  <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
<form action="/html/cambio_clave.php" method="POST" name="formulario" class="formulario">
          <h1>Cambio contraseña</h1>
          <!-- Contraseña actual -->
          <div class="form-group" id="password-group">
            <input type="password" name="actualPass" id="actualPass" placeholder="Contraseña actual" required>
          </div>
          <!-- Contraseña nueva -->
          <div class="form-group" id="password-group">
          <input class="newPass" type="password" name="nPass" id="nPass" placeholder="Contraseña nueva" required>
            <!-- <?php
            // if (empty($contraseña_err)) {
            //   echo "<input type=\"password\" class=\"form-control\" placeholder=\"nueva contraseña\" name=\"nPass\" />"; //nPass = new password
            // } else {
            //   echo "<input type=\"password\" class=\"form-control is-invalid\" placeholder=\"nueva contraseña\" name=\"nPass\" />"; //nPass = new password
            //   echo "<div class=\"invalid-feedback\">";
            //   echo $contraseña_err;
            //   echo "</div>";
            // }
            ?> -->
          </div>
          <div class="form-group" id="password-group">
          <input class="newPass"type="password" name="confPass" id="confPass" placeholder="Confirmar contraseña" required>
            <!-- <?php
            // if (empty($contraseña_err)) {
            //   echo "<input type=\"password\" class=\"form-control\" placeholder=\"confirmar contraseña\" name=\"confPass\" />";
            // } else {
            //   echo "<input type=\"password\" class=\"form-control is-invalid\" placeholder=\"confirmar contraseña\" name=\"confPass\" />";
            //   echo "<div class=\"invalid-feedback\">";
            //   echo $contraseña_err;
            //   echo "</div>";
            // }
            ?> -->
          </div>
          <div class="alertPass" style="display: none;">
          
          </div> 
</body>

</html>