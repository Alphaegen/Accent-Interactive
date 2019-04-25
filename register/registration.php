<body>
	<div class="container">
		<div class="row">
			<div class="col-md col-md-offset-3 control-panel">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="activate-form-link"><input type="button" value="Activate" class="control btn"></a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link"><input type="button" value="Register" class="control btn"></a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">

<!-- Activate Account -->
								<form id="activate-form" role="form" style="display: block;">
									<h1>Activate a new account</h1>
									<div class="form-group">
										<input type="text" name="username" id="useractivation" tabindex="3" class="form-control" placeholder="Email" value="">
									</div>
									<div class="form-group">
										<input type="text" name="code" id="activationcode" tabindex="4" class="form-control" placeholder="Activation code">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-6 col-sm-offset-3">
												<input type="button" name="activate-submit" id="activate-submit" tabindex="4" class="form-control control btn btn-login" value="Send">
											</div>
										</div>
									</div>
								</form>

<!-- Register Form -->
								</form>
								<form id="register-form" method="post" role="form" style="display: none;">
									<h1>Register</h1>
									<div class="form-group">
										<input type="text" name="fname" id="fname" tabindex="1" class="form-control half" placeholder="First name" value="">
										<input type="text" name="index" id="index" tabindex="1" class="form-control half" placeholder="Infix" value="">
									</div>
									<div class="form-group">
										<input type="text" name="lname" id="lname" tabindex="1" class="form-control" placeholder="Last name" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="tel" name="telephone" id="telephone" tabindex="2" class="form-control" placeholder="06-00000000">
									</div>
									<div class="form-group">
										<input type="text" name="sname" id="sname" tabindex="2" class="form-control half" placeholder="Streetname">
										<input type="text" name="snumber" id="snumber" tabindex="2" class="form-control half" placeholder="Streetnumber">
									</div>
									<div class="form-group">
										<input type="text" name="postcode" id="postcode" tabindex="2" class="form-control half" placeholder="Postcode">
										<input type="text" name="city" id="city" tabindex="2" class="form-control half" placeholder="City">
									</div>
									<div class="form-group">
										<select id="country">
											<option value="NL">Netherlands</option>
											<option value="BE">Belgium</option>
											<option value="DE">Germany</option>
										</select>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password2" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-6 col-sm-offset-3">
												<input type="button" name="register-submit" id="register-submit" tabindex="4" class="control form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function() {

			console.log($("#register-submit").val());

			$("#register-submit").click(function() {
				console.log('hello');

				if ($("#fname").val() != "" && $("#lname").val() != "" && $("#email").val() != "" && $("#password2").val() != "" && validateEmail($("#email").val())) {
					if ($("#password2").val() === $("#confirm-password").val()) {
						$.ajax({
							method: "POST",
							url: "<?=registerfile?>",
							data: {
								fname: $("#fname").val(),
								infix: $("#infix").val(),
								lname: $("#lname").val(),
								email: $("#email").val(),
								telephone: $("#telephone").val(),
								sname: $("#sname").val(),
								snumber: $("#snumber").val(),
								postcode: $("#postcode").val(),
								city: $("#city").val(),
								country: $("#country").val(),
								password: $("#confirm-password").val()
							}
						}).done(function(msg) {
							alert(msg);
						});
					} else {
						alert("Passwords do not match!");
					}

				} else {
					alert("Please fill all fields with valid data!");
				}
			});

			$("#activate-submit").click(function() {
				if ($("#useractivation").val() != "" && $("#activationcode").val() != "" && validateEmail($("#useractivation").val())) {
					$.ajax({
						method: "POST",
						url: "<?=activatefile?>",
						data: {
							email: $("#useractivation").val(),
							code: $("#activationcode").val()
						}
					}).done(function(msg) {
						if (msg !== "") {
							alert(msg);
						} else {
							window.location = "<?=userfile?>";
						}
					});
				} else {
					alert("Please fill all fields with valid data!");
				}
			});

		});
	</script>
</body>
</html>
