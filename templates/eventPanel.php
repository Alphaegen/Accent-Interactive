  <?php if($_SESSION['user']['user_role'] == 2){
    $x=0;
    ?>
<!DOCTYPE html>
<body>

<div class="adminInfo eventPage hidden">
  <div>
    <h2>Welcome <?php print $_SESSION['user']['fname'].' '.$_SESSION['user']['lname']; ?></h2>
    <h1>Events: </h1>
  </div>
      <table>
        <thead>
          <tr>
            <th width="12%">Img</th>
            <th width="8%">Event</th>
            <th width="1%">Seats</th>
            <th width="8%">StartTime</th>
            <th width="8%">StopTime</th>
            <th width="10%">City</th>
            <th width="10%">Address</th>
            <th width="20%">Description</th>
            <th width="10%">Small Desc</th>
            <th width="8%">Price</th>
            <th width="5%">Edit</th>
          </tr>
        </thead>
        <tbody>
        <?php
        	foreach ($vars as $event) {
        	?>
          <tr <?php echo' class="event'.$x.'"'?>>
            <th><input readonly type="text" class="img" value="<?=$event['img']?>"></th>
  	        <th><input readonly type="text" class="eventname" value="<?=$event['eventname']?>"></th>
            <th><input readonly type="text" class="seats" value="<?=$event['seats']?>"></th>
            <th><input readonly type="date" class="starttime" value="<?=$event['starttime']?>"></th>
            <th><input readonly type="date" class="endtime" value="<?=$event['endtime']?>"></th>
            <th><input readonly type="text" class="city" value="<?=$event['city']?>"></th>
            <th><input readonly type="text" class="address" value="<?=$event['address']?>"></th>
            <th><input readonly type="text" class="description" value="<?=$event['description']?>"></th>
            <th><input readonly type="text" class="smalldesc" value="<?=$event['smalldesc']?>"></th>
            <th><input readonly type="text" class="price" value="<?=$event['price']?>"></th>
            <th><input class="event-remove-submit btn remove-btn" type="submit" name="submit" value="Remove"><input class="event-edit-submit btn edit-btn" type="submit" name="submit" value="Edit"><input class="event-finish-submit hidden btn finish-btn" type="submit" name="submit" value="Finish"></th>
            <input class="id" type="hidden" name="" value="<?=$event['id']?>">
          </tr>
    	<?php
      $x += 1;
    	}
      ?>
      <tr class="newEvent">
        <th><input type="text" class="img" value=""></th>
        <th><input type="text" class="eventname" value=""></th>
        <th><input type="text" class="seats" value=""></th>
        <th><input type="date" class="starttime" value=""></th>
        <th><input type="date" class="endtime" value=""></th>
        <th><input type="text" class="city" value=""></th>
        <th><input type="text" class="address" value=""></th>
        <th><input type="text" class="description" value=""></th>
        <th><input type="text" class="smalldesc" value=""></th>
        <th><input type="text" class="price" value=""></th>
        <th><input class="event-add-submit btn add-btn" type="submit" name="submit" value="Add"></th>
      </tr>
      </tbody>
    </table>
</div>
<?php require_once 'ajax/EventPanelFunc.php'; ?>

</body>
</html>
<?php } else {
  echo "You are not logged in!";
} ?>
