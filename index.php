<?php
require_once ('templates/header.php');
 ?>

 <!--- Image Slider -->
 <div id="slides" class="carousel slide" data-ride="carousel">
   <ul class="carousel-indicators">
     <li data-target="#slides" data-slide-to="0" class="active"></li>
     <li data-target="#slides" data-slide-to="1"></li>
     <li data-target="#slides" data-slide-to="2"></li>
   </ul>
   <div class="carousel-inner">
     <div class="carousel-item active">
       <img src="img/header1-min.webp" alt="Events">
       <div class="carousel-caption">
         <h1 class="display-2"> Buggin Events</h1>
         <h3>Get you latest tickets right here!</h3>
         <button class="btn btn-outline-light btn-lg" onclick="window.location.href='#ticket-container'" type="button" >Tickets</button>
       </div>
     </div>
     <div class="carousel-item">
       <img src="img/header2-min.webp" alt="Events">
       <div class="carousel-caption">
         <h1 class="display-2"> Buggin Events</h1>
         <h3>Get you latest tickets right here!</h3>
         <button class="btn btn-outline-light btn-lg" onclick="window.location.href='#ticket-container'" type="button" >Tickets</button>
       </div>
     </div>
     <div class="carousel-item">
       <img src="img/header3-min.webp" alt="Events">
       <div class="carousel-caption">
         <h1 class="display-2"> Buggin Events</h1>
         <h3>Get you latest tickets right here!</h3>
         <button class="btn btn-outline-light btn-lg" onclick="window.location.href='#ticket-container'" type="button" >Tickets</button>
       </div>
     </div>
   </div>
 </div>


 <!--- Welcome Section -->
 <div class="container-fluid padding" id="ticket-container">
	 <div class="row welcome text-center">
		 <div class="col-12">
       <?php if (isset($_GET['id'])) { ?>
         <h1 class="display-4"> Event Details</h1>
       <?php } else { ?>
         <h1 class="display-4"> Popular events</h1>
        <?php } ?>
		 </div>
	 </div>
 </div>

<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $user->detailPage($id);
} else {
  $user->events();
}
  ?>

<?php
	require_once("templates/footer.php");
 ?>
