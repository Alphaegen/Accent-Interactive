<?php
    require_once '../functions/userFunctions.php';
    require_once '../config.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$users = filter_input(INPUT_POST, 'user', FILTER_VALIDATE_BOOLEAN);
$event = filter_input(INPUT_POST, 'event', FILTER_VALIDATE_BOOLEAN);
$order = filter_input(INPUT_POST, 'order', FILTER_VALIDATE_BOOLEAN);
// AddUser
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
    $wrong_logins = filter_input(INPUT_POST, 'wrong_logins', FILTER_SANITIZE_STRING);
    $user_role = filter_input(INPUT_POST, 'user_role', FILTER_SANITIZE_STRING);
    $confirmed = filter_input(INPUT_POST, 'confirmed', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// AddEvent
    $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_STRING);
    $eventname = filter_input(INPUT_POST, 'eventname', FILTER_SANITIZE_STRING);
    $seats = filter_input(INPUT_POST, 'seats', FILTER_SANITIZE_STRING);
    $starttime = filter_input(INPUT_POST, 'starttime', FILTER_SANITIZE_STRING);
    $endtime = filter_input(INPUT_POST, 'endtime', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $smalldesc = filter_input(INPUT_POST, 'smalldesc', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);

// AddOrder
    $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);

    if ($user==true) {
      if($user->AddUser($email, $fname, $infix, $lname, $telephone, $sname, $snumber, $postcode, $city, $country, $wrong_logins, $user_role, $confirmed, $password, $id)) {
          die;
      } else {
          $user->printMsg();
          die;
      }

    } elseif ($event==true) {
      if($user->AddEvent($img, $eventname, $seats, $starttime, $endtime, $city, $address, $description, $smalldesc, $price, $id)) {
          die;
      } else {
          $user->printMsg();
          die;
      }

    } elseif ($order==true) {
      if($user->AddOrder($email, $eventname, $seats, $total, $id)) {
          die;
      } else {
          $user->printMsg();
          die;
      }
    } else {
      alert("Something Failed");
    }
