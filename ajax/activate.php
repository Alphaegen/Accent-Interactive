<?php
    require_once '../functions/userFunctions.php';
    require_once '../config.php';

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $code = filter_input(INPUT_POST, 'code', FILTER_DEFAULT);

    if($user->emailActivation( $email, $code)) {
        die;
    } else {
        $user->printMsg();
        die;
    }
