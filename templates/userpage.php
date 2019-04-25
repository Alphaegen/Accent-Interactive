<?php if (isset($_SESSION['user']['email'])) {
  $y=0;
  ?>
<!DOCTYPE html>
<body>

<div class="adminInfo userpage">
  <div id="dialog-form" title="Create new user">
          <p class="validateTips">All form fields are required.</p>
          <form>
         <fieldset>
           <label for="password"><b>Password:</b></label>
            <input type="password" name="password" id="password" value="" class="text">
          <label for="password"><b>Confirm Password:</b></label>
           <input type="password" name="conf-password" id="conf-password" value="" class="text">
           <input id="conf-button" type="button" name="submit" value="Submit">
        </fieldset>
        </form>
       </div>
  <div>
    <h2>Welcome <?php print $_SESSION['user']['fname'].' '.$_SESSION['user']['lname']; ?></h2>
    <h1>Users: </h1>
  </div>
          <table>
            <?php if($_SESSION['user']['user_role'] == 2){
              ?>
        <thead>
          <tr>
            <th width="7%">Firstname</th>
            <th width="5%">Infix</th>
            <th width="8%">Lastname</th>
            <th width="15%">Email</th>
            <th width="10%">Telephone</th>
            <th width="10%">Street</th>
            <th width="5%">Number</th>
            <th width="10%">City</th>
            <th width="5%">Postcode</th>
            <th width="5%">Country</th>
            <th width="5%">wrong<br>login</th>
            <th width="5%">Role</th>
            <th width="5%">Confirmed</th>
            <th width="5%">Edit</th>
          </tr>
        </thead>
        <tbody>
        <?php
        	foreach ($vars as $user) {
        	?>
          <tr <?php echo' class="user'.$y.'"'?>>
            <th><input readonly type="text" class="fname" value="<?=$user['fname']?>"></th>
            <th><input readonly type="search" class="infix" value="<?=$user['infix']?>"></th>
  	        <th><input readonly type="text" class="lname" value="<?=$user['lname']?>"></th>
            <th><input readonly type="email" class="email" value="<?=$user['email']?>"></th>
            <th><input readonly type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="telephone" value="<?=$user['telephone']?>"></th>
            <th><input readonly type="text" class="sname" value="<?=$user['sname']?>"></th>
            <th><input readonly type="text" class="snumber" value="<?=$user['snumber']?>"></th>
            <th><input readonly type="text" class="city" value="<?=$user['city']?>"></th>
            <th><input readonly type="text" class="postcode" value="<?=$user['postcode']?>"></th>
            <th><input readonly type="text" class="country" value="<?=$user['country']?>"></th>
            <th><input readonly type="text" class="wrong_logins" value="<?=$user['wrong_logins']?>"></th>
            <th><input readonly type="text" class="user_role" value="<?=$user['user_role']?>"></th>
  	        <th><input readonly type="text" class="confirmed" value="<?=$user['confirmed']?>"></th>
            <th><input class="user-remove-submit btn remove-btn" type="submit" name="submit" value="Remove"><input class="user-edit-submit btn edit-btn" type="submit" name="submit" value="Edit"><input class="user-finish-submit hidden btn finish-btn" type="submit" name="submit" value="Finish"></th>
            <input class="id" type="hidden" name="" value="<?=$user['id']?>">
          </tr>
    	<?php
      $y += 1;
    	}
      ?>
      <tr class="newUser">
        <th><input type="text" class="fname" value=""></th>
        <th><input type="search" class="infix" value=""></th>
        <th><input type="text" class="lname" value=""></th>
        <th><input type="email" class="email" value=""></th>
        <th><input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="telephone" value=""></th>
        <th><input type="text" class="sname" value=""></th>
        <th><input type="text" class="snumber" value=""></th>
        <th><input type="text" class="city" value=""></th>
        <th><input type="text" class="postcode" value=""></th>
        <th><input type="text" class="country" value=""></th>
        <th><input type="text" class="wrong_logins" value=""></th>
        <th><input type="text" class="user_role" value=""></th>
        <th><input type="text" class="confirmed" value=""></th>
        <th><input class="user-add-submit btn" type="submit" name="submit" value="Add"></th>
      </tr>
    <?php }else{ ?>
      <thead>
        <tr>
          <th width="5%">Firstname</th>
          <th width="5%">Infix</th>
          <th width="5%">Lastname</th>
          <th width="10%">Email</th>
          <th width="5%">Telephone</th>
          <th width="8%">Street</th>
          <th width="5%">Number</th>
          <th width="5%">City</th>
          <th width="5%">Postcode</th>
          <th width="5%">Country</th>
          <th width="5%">Confirmed</th>
        </tr>
      </thead>
      <tbody>
        <tr class="self">
          <th><input readonly type="text" class="fname" value="<?=$_SESSION['user']['fname']?>"></th>
          <th><input readonly type="search" class="infix" value="<?=$_SESSION['user']['infix']?>"></th>
          <th><input readonly type="text" class="lname" value="<?=$_SESSION['user']['lname']?>"></th>
          <th><input readonly type="email" class="email" value="<?=$_SESSION['user']['email']?>"></th>
          <th><input readonly type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="<?=$_SESSION['user']['telephone']?>"></th>
          <th><input readonly type="text" class="sname" value="<?=$_SESSION['user']['sname']?>"></th>
          <th><input readonly type="text" class="snumber" value="<?=$_SESSION['user']['snumber']?>"></th>
          <th><input readonly type="text" class="city" value="<?=$_SESSION['user']['city']?>"></th>
          <th><input readonly type="text" class="postcode" value="<?=$_SESSION['user']['postcode']?>"></th>
          <th><input readonly type="text" class="country" value="<?=$_SESSION['user']['country']?>"></th>
          <th><input readonly type="text" class="confirmed" value="<?=$_SESSION['user']['confirmed']?>"></th>
        </tr>
    <?php } ?>
      </tbody>
    </table>
</div>
<?php require_once 'ajax/UserPanelFunc.php'; ?>

<?php } else {
  echo("You are not logged in!");
} ?>
