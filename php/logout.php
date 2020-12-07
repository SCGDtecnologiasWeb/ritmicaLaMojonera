<?php
session_start();

$_SESSION = array();
session_destroy();

header("location: /html/index.php");
exit;
