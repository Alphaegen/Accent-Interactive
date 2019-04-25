<?php
require_once '../functions/userFunctions.php';
require_once '../config.php';

    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $infix = filter_input(INPUT_POST, 'infix', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
    $sname = filter_input(INPUT_POST, 'sname', FILTER_SANITIZE_STRING);
    $snumber = filter_input(INPUT_POST, 'snumber', FILTER_SANITIZE_STRING);
    $postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    if($user->registration($email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $pass)) {
        print 'A confirmation mail has been sent, please confirm your account registration!';
        die;
    } else {
        $user->printMsg();
        die;
    }
