<?php 
require_once('../conn/db.php');
use DbConnectAPI\DataSource;
$con = new DataSource;
session_start(); 
if ( isset($_GET['checkuser']) ){
    if ( $_GET['checkuser'] == 'username' ){
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM users WHERE username LIKE '{$keyword}'";
        $val = $con->getRecordCount($query, 's');

        if($val > 0){
            echo "A user already exists with the given credentials";
        }else{
            echo "OK";
        }
        exit();
    }
    if ( $_GET['checkuser'] == 'email' ){
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM users WHERE user_email LIKE '{$keyword}'";
        $val = $con->getRecordCount($query, 's');

        if($val > 0){
            echo "A user already exists with the given credentials";
        }else{
            echo "OK";
        }
        exit();
    }
}

    $dob = date('Y-m-d', strtotime($_POST['dob']));
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password0 = $_POST['pass1'];
    $salt = 'uliza2023.';
    $password1 = md5($password0);
    $password = $salt.$password1; 
    try{
        $query = "INSERT INTO `users`(`username`, `user_email`, `dob`, `password`) VALUES ('$username','$email','$dob','$password')";
        $con->execute($query, 'ssis');
        $query = "SELECT * FROM users WHERE user_email ='$email'";
        $row = $con->getRecordCount($query, 's');
        if ($row > 0){
            $_SESSION['msg'] = 'Account registration successfull..Please Login';
            header('location:../');
        }else{
            throw new Exception('Account registration error..Please try again later');
        }        
    }catch(Exception $err){
        $_SESSION['msg'] = $err->getMessage();
        header('location:../register.php');
    }
?>