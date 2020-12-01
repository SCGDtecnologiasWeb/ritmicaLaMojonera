<?php

include('config.php');
session_start();

if (isset($_POST['continuar'])) {

    $username = $_POST['usuario'];
    $password = $_POST['contraseña'];

    $query = $connection->prepare("SELECT * FROM administrador WHERE correoAdmin=:usuario");
    $query->bindParam("usuario", $username, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        if (password_verify($password, $result['contraseña'])) {
            $_SESSION['user_id'] = $result['ID'];
            echo '<p class="success">Congratulations, you are logged in!</p>';
        } else {
            echo '<p class="error">Username password combination is wrong!</p>';
        }
    }
}
