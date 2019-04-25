<?php
	require_once ('functions/userFunctions.php');
	require_once ('config.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Buggin Events</title>

	<!-- Bootstrap -->
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Jquery -->
	<script src="js/jquery-3.4.0.min.js"></script>

	<!-- JqueryUI -->
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-ui.min.js"></script>

	<!-- Other -->
	<script src="functions/main.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/equal-height-columns.css">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/adminpanel.css">
</head>
<body>

<!-- Header/Navbar -->
<header>
	<nav class="navbar navbar-expand-md navbar-light bg-light stickey top" id="top">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php"><img src="img/logo-min.png"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<!-- LoginForm Render -->
						<?php $user->loginForm(); ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
