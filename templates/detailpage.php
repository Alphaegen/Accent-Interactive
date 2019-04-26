<!-- Page Content -->
<div class="container eventdetailpage">
<?php foreach ($vars as $eventdetail) { ?>
  <?php if ($eventdetail['seats']>1) { ?>

  <!-- Portfolio Item Heading -->
  <h1 class="my-4"><?=$eventdetail['eventname'] ?>
    <small>| <?=$eventdetail['city'] ?></small>
  </h1>

  <!-- Portfolio Item Row -->
  <div class="row" id="detail-container">

    <div class="col-md-12">
      <img class="img-fluid" src="img/events/<?=$eventdetail['img'];?>" alt="">
    </div>
    <div class="col-md-12">
      <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="400px" id="gmap_canvas" src="https://maps.google.com/maps?q=<?=$eventdetail['city']?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com"></a></div>
      <style>.mapouter{position:relative;text-align:right;}.gmap_canvas {overflow:hidden;background:none!important;}</style></div>
    </div>

    <div id="detailform" class="col-md-12">
      <h3 class="my-3">Event Description</h3>
      <p><?=$eventdetail['description'] ?></p>
      <h3 class="my-3">Event Details</h3>
      <ul>
        <li class="border-bot">&#183; <?=$eventdetail['city'] ?></li>

        <?php if($eventdetail['address']!="") { ?>
        <li class="border-bot"><b>&#183;<?=$event['address']." ".$event['city'];?></b></li>
      <?php } ?>
      <li class="border-bot">&#183; <b> <?=$eventdetail['seats'];?> Tickets remaining</b></li>

        <li class="border-bot">&#183; <b> <?=date("d/m", strtotime($eventdetail['starttime']))."  -  ".date("d/m", strtotime($eventdetail['endtime']));?></b></li>
        <br>
        <li class="no-listdecor"><input type="number" class="quantity" value="1"><b class="price">&#8364; <?=$eventdetail['price'] ?></b></li>
      </ul>
      <input id="event-buy-btn" class="form-control btn btn-right mobile" type="button" name="buy" value="buy">
    </div>
  </div>
  </div>
  <?php require_once('ajax/CreateOrderFunc.php'); ?>
  <!-- /.row -->
<?php
} else { ?>

<?php }
} ?>
</div>
<!-- /.container -->
