<?php
require_once '../functions/userFunctions.php';
require_once '../config.php';

    $user->logout();
    header('location: ../index.php');
?>
