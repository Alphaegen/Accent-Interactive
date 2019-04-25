<?php if (!isset($_SESSION['user'])) { ?>



	<div class="loginform">
		<input type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-right btn-unresponsive" value="Log In">
		<input type="password" name="password" id="password1" tabindex="2" class="form-control" placeholder="Password">
		<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Email" value="">
		<input type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-responsive mobile" value="Log In">
		<a href="registerPage.php"><input type="button" name="register-submit-head" id="register-submit-head" tabindex="4" class="form-control btn btn-right mobile" value="Register"></a>
	</div>
	<script type="text/javascript">
		$(function() {
			$("#login-submit").click(function(){
				if($("#username").val() != "" && $("#password1").val() != "" && validateEmail($("#username").val())){
					$.ajax({
					  method: "POST",
					  url: "<?=loginfile?>",
					  data: { username: $("#username").val(), password: $("#password1").val() }
					}).done(function( msg ) {
					    if(msg !== ""){
					    	alert(msg);
					    }else{
								location.reload();
					    }
					});
				}else{
					alert("Please fill all fields with valid data!");
				}
			});
		});
	</script>

<?php
} else { ?>

	<div class="loginform">
		<a href='functions/logout.php'><input type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-logout" value="Log Out"></a>
		<?php if ($_SESSION['user']['user_role'] == 2) {?>
			<a href="adminPanel.php"><input type="button" tabindex="4" class="form-control btn btn-adminPanel" value="AdminPanel"></a>
		<?php } else { ?>
			<a href="adminPanel.php"><input type="button" tabindex="4" class="form-control btn btn-adminPanel" value="User"></a>
		<?php } ?>
	</div>
<?php
}
?>
