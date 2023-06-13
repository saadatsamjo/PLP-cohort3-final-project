<?php 
	//namespace DbConnectAPI;
    require_once('../conn/db.php');
    //require('setcookies.php');
    use DbConnectAPI\DataSource;
    
    $con = new DataSource;
    session_start();
    $username = $_POST['username'];
    $password0 = $_POST['password'];
    $salt = 'uliza2023.';
    $password1 = md5($password0);
    $password = $salt.$password1; 
    try{
        $query = "SELECT * FROM users WHERE (username ='$username' OR user_email ='$username') AND password='$password'";  

        $count = $con->getRecordCount($query, 'ss');
        if($count > 0){
            $row = $con->select($query, 'ss');
            $_SESSION['id']=$row[0]['user_id'];
            $_SESSION['userdata']=$row[0];
            $_SESSION['userIsLoggedIn']=true;
            $query = "UPDATE `users` SET `status`='Online' WHERE username='$username'";
            $con->execute($query, 's');
            $_SESSION['msg'] = "Authorized";
            header('location:dashboard.php');            
        }else{
            throw new Exception("The entered credentials do not match any user");
        }
    }catch(Exception $err){
        $_SESSION['msg'] = $err->getMessage();
        header('location:../');
    }
?>