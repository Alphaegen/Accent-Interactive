     <?php
require_once '../functions/userFunctions.php';
require_once '../config.php';
	if (isset($_SESSION['user'])){
	  	$user->userPage();
	}else{
		header(indexfile);
		echo "not logged in";
	}
?>
