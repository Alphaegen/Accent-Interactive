<?php
require_once ('functions/userFunctions.php');
require_once ('config.php');
require_once ('templates/header.php');

if (isset($_SESSION['user']['email'])) {
  echo "You are already logged in!";
} else {
  $user->registerForm();
}
?>

 <?php
 	require_once("templates/footer.php");
  ?>
