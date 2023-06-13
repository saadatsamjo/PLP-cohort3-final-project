<?php
	require_once('../conn/db.php');
    use DbConnectAPI\DataSource;    
    $con = new DataSource;
    session_start();
    $userid=$_SESSION['id'];
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try{
		$query = "UPDATE users SET status = 'Offline' WHERE user_id = '$userid'";
    	$con->execute($query, 'i');
    	session_destroy();
		header('location:../index.php');
    }catch(Exception $err){
        echo "<p>".$err->getMessage()."</p>";
        exit();
    }    
	
?>