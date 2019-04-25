<?php
require_once '../functions/userFunctions.php';
require_once '../config.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$users = filter_input(INPUT_POST, 'user', FILTER_VALIDATE_BOOLEAN);
$event = filter_input(INPUT_POST, 'event', FILTER_VALIDATE_BOOLEAN);
$order = filter_input(INPUT_POST, 'order', FILTER_VALIDATE_BOOLEAN);

if ($user==true) {
  if($user->RemoveUser($id)) {
      die;
  } else {
      $user->printMsg();
      die;
  }

} elseif ($event==true) {
  if($user->RemoveEvent($id)) {
      die;
  } else {
      $user->printMsg();
      die;
  }

} elseif ($order==true) {
  if($user->RemoveOrder($id)) {
      die;
  } else {
      $user->printMsg();
      die;
  }
} else {
  alert("Something Failed");
}
