<?php if(isset($_SESSION['user']['email'])) {
  $x=0;
  if(isset($_GET['id'])) {
    $message = "Your order has been completed!";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
  ?>
<!DOCTYPE html>
<body>

<div class="adminInfo orderPage hidden">
<div>
  <h2>Welcome <?php print $_SESSION['user']['fname'].' '.$_SESSION['user']['lname']; ?></h2>
  <h1>Orders: </h1>
</div>
    <table>
      <thead>
        <tr>
          <th width="40%">Email</th>
          <th width="20%">Event</th>
          <th width="20%">Quantity</th>
          <th width="10%">Total</th>
          <th width="10%">Bought At</th>
          <?php if ($_SESSION['user']['user_role']==2) { ?>
          <th width="1%">Edit</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
      <?php
      if($_SESSION['user']['user_role']==2) {
        foreach ($vars as $order) {
        ?>
        <tr <?php echo' class="order'.$x.'"'?>>
          <th><input readonly type="text" class="email" value="<?=$order['user_email']?>"></th>
          <th><input readonly type="text" class="eventname" value="<?=$order['eventname']?>"></th>
          <th><input readonly type="text" class="seats" value="<?=$order['seats']?>"></th>
          <th><input readonly type="text" class="total" value="<?=$order['total']?>"></th>
          <th><input readonly type="text" class="total" value="<?=$order['timestamp']?>"></th>
          <th><input class="order-remove-submit btn remove-btn" type="submit" name="submit" value="Remove"><input class="order-edit-submit btn edit-btn" type="submit" name="submit" value="Edit"><input class="order-finish-submit hidden btn finish-btn" type="submit" name="submit" value="Finish"></th>
          <input class="id" type="hidden" name="" value="<?=$order['id']?>">
        </tr>
    <?php
    $x += 1;
    }
    ?>
    <tr class="newOrder">
      <th><input readonly type="text" class="email" value=""></th>
      <th><input readonly type="text" class="eventname" value=""></th>
      <th><input readonly type="text" class="seats" value=""></th>
      <th><input readonly type="text" class="total" value=""></th>
      <th><input class="event-add-submit btn add-btn" type="submit" name="submit" value="Add"></th>
    </tr>
  <?php } else {
      foreach ($vars as $order) {
    ?>
    <tr class="yourOrder">
      <th><input readonly type="text" class="email" value="<?=$order['user_email']?>"></th>
      <th><input readonly type="text" class="eventname" value="<?=$order['eventname']?>"></th>
      <th><input readonly type="text" class="seats" value="<?=$order['seats']?>"></th>
      <th><input readonly type="text" class="total" value="<?=$order['total']?>"></th>
      <th><input readonly type="text" class="total" value="<?=$order['timestamp']?>"></th>
      <input class="id" type="hidden" name="" value="<?=$order['id']?>">
    </tr>
  <?php } ?>
    </tbody>
  </table>
</div>
<?php require_once 'ajax/CreateOrderFunc.php'; ?>

</body>
</html>
<?php
  }
}
?>
