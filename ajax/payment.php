<?php
    require_once '../functions/userFunctions.php';
    require_once '../config.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
// AddUser
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

  if($user->Pay($id, $email, $quantity)) {
      die;
  } else {
      $user->printMsg();
      die;
  }
