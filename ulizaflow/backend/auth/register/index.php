<?php 
require_once('../../conn/db.php');
use UlizaFLOW\DbConnectAPI\DataSource;

    class Register extends DataSource {
        function checkUser($key, $value){
            if ( $key == 'username' ){
                $query = "SELECT * FROM users WHERE username LIKE '{$value}'";
                $val = $this->getRecordCount($query, 's');

                if($val > 0){
                    return "A user already exists with the given credentials";
                }else{
                    return "OK";
                }
                exit();
            }
            if ( $key == 'email' ){
                $query = "SELECT * FROM users WHERE user_email LIKE '{$value}'";
                $val = $this->getRecordCount($query, 's');

                if($val > 0){
                    return "A user already exists with the given credentials";
                }else{
                    return "OK";
                }
                exit();
            }
        }
        private function securePass($password) {
            $salt = 'uliza2023.';
            $password1 = md5($password);
            return $salt.$password1;
        }
        function registerUser($username, $email, $dob, $password) {
            $date = date('Y-m-d', strtotime($dob));
            $securepass =  $this->securePass($password);
            //$this->checkUser($key, $value);
            try{
                $query = "INSERT INTO `users`(`username`, `user_email`, `dob`, `password`) VALUES ('$username','$email','$dob','$securepass')";
                $this->execute($query, 'ssis');
                $query = "SELECT * FROM users WHERE user_email ='$email'";
                $row = $this->getRecordCount($query, 's');
                if ($row > 0){
                    return 'Account registration successfull';
                }else{
                    throw new Exception('Account registration error..Please try again later');
                }        
            }catch(Exception $err){
                return $err->getMessage();
            }
        }
    }

$Register = new Register;
header('Content-Type: application/json');
if (isset($_GET['checkuser'])) {
    if (isset($_GET['key']) && !empty($_GET['key']) && isset($_GET['value']) && !empty($_GET['value'])) {
        $key = $_GET['key'];
        $value = $_GET['value'];
        $response = $Register->checkUser($key, $value);
        echo $response;
    }else{
        echo "Empty Request";
    }
    
}
if (isset($_GET['registeruser'])) {
    if (isset($_GET['username']) && !empty($_GET['username']) && isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['dob']) && !empty($_GET['dob']) && isset($_GET['password']) && !empty($_GET['password']) ) {
        $username = $_GET['username'];
        $email = $_GET['email'];
        $dob = $_GET['dob'];
        $password = $_GET['password'];    
        $response = $Register->registerUser($username, $email, $dob, $password);
        echo $response;
    }else{
        echo "Empty Request";
    }
    
}   
?>