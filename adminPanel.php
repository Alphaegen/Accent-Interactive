<?php
require_once ('templates/header.php');
 ?>

 <!--- Admin Panel Section -->
 <div class="container-fluid padding" id="ticket-container">
  <div class="row welcome text-center">
    <div class="col-12">
      <?php if ($_SESSION['user']['user_role']==2) { ?>
      <h1 class="display-4"> Admin Panel</h1>
    <?php } else { ?>
      <h1 class="display-4"> User Panel</h1>
    <?php } ?>
    </div>
    <div class="row links">
      <div class="col center btn users-btn">User</div>
      <div class="col center btn orders-btn">Orders</div>
      <?php if ($_SESSION['user']['user_role']==2) { ?>
        <div class="col center btn events-btn">Events</div>
    <?php } ?>
    </div>
  </div>
 </div>


 <?php
 $user->userPage();
 $user->orderPage();


 if ($_SESSION['user']['user_role']==2) {
   $user->eventPage();
 }
 	require_once("templates/footer.php");
  ?>
