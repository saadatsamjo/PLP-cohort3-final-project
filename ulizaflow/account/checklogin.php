<?php 
	session_start();
	if ( !isset($_SESSION['userIsLoggedIn'])){
		$_SESSION['msg'] = "You are not Logged In!";
		header('location:../');
	}
?>