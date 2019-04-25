<?php
session_start();
define('conString', 'mysql:host=localhost;dbname=buggin_Events');
define('dbUser', 'buggin_Admin');
define('dbPass', '95u2Sx2lffRB');

define('__ROOT__', dirname(__FILE__));

// User Ajax Files
define('userfile', 'user.php');
define('loginfile', 'ajax/login.php');
define('activatefile', 'ajax/activate.php');
define('registerfile', 'ajax/register.php');
define('editfile', 'ajax/edit.php');
define('removefile', 'ajax/remove.php');
define('addfile', 'ajax/add.php');
define('payment', 'ajax/payment.php');



//Index Template files
define('indexfile','http://bugginevents.gluweb.nl/');
define('loginForm', __ROOT__.'/templates/loginform.php');

// Register Template Files
define('registerForm', __ROOT__.'/register/registration.php');

// Ticketpage template files
define('tickets', __ROOT__.'/templates/tickets.php');
define('detailpage', __ROOT__.'/templates/detailpage.php');


// AdminPage Template files
define('adminPage', 'adminPanel.php?id='.$_GET['id']);
define('userPage', 'templates/userpage.php');
define('eventList', 'templates/eventPanel.php');
define('orderList', 'templates/orderlist.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = new User();
$user->dbConnect(conString, dbUser, dbPass);
