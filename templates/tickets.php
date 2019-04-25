<div class="container tickets">
  <div class="row row-eq-height">
  <?php
  $currdate = date("Y-m-d");
  $y=0;
  foreach ($vars as $event) {
    $y++;
    if($y==9) {
      break;
    }
    if($event['endtime']<$currdate) {
      $y--;
      } else {
    ?>
    <div class="col-xl-3 col-sm-6 card-color">
      <div class="card text-center">
        <div class="card-block <?="event".$y ?>">
          <a href="?id=<?=$event['id']; ?>"><img src="img/events/<?=$event['img'];?>" alt="<?=$event['eventname'];?>"></a>
          <div class="card-text">
            <div class="card-title">
              <a href="?id=<?=$event['id']; ?>"><h4><?=$event['eventname'];?></h4></a>
            </div>
            <ul>
              <li class="border-bot"><span><b><?=date("d/M", strtotime($event['starttime']));?></b></span>
                  <span><b><?php
                    if ($event['endtime']!=$event['starttime']) {
                    echo ("  -  ".date("d/M", strtotime($event['endtime'])));
                    }?></b></span></li>

                    <?php if ($event['seats']!="") { ?>
                    <li class="border-bot"><b><?=$event['seats'];?> tickets remaining</b></li>
                  <?php } ?>

              <li class="border-bot"><b><?=$event['address']." ".$event['city'];?></b></li>

              <?php if ($event['smalldesc']!="") { ?>
              <li><?=$event['smalldesc'];?></li>
            <?php } ?>

            </ul>
          </div>
          <a href="?id=<?=$event['id']; ?>"><input type="button" tabindex="4" class="form-control btn btn-buy" value="Details"></a>
      </div>
    </div>
  </div>
  <?php
  }
}
?>
  </div>
</div>
