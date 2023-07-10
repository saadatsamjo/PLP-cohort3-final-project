<?php 
	session_start();
	class checkLogin {

		function select() {
			if ( !isset($_SESSION['userIsLoggedIn'])){
				return "You are not Logged In!";
			}else{
				return "Authenticated";
			}

		}

	}
$checkLogin = new checkLogin;
header('Content-Type: application/json');
if (isset($_GET['check'])){
	$response = $checkLogin->select();
	echo $response;	
}

?>