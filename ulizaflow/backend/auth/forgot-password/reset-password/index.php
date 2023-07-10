<?php 
date_default_timezone_set("Africa/Nairobi");
    require('../../../conn/db.php');
    use UlizaFLOW\DbConnectAPI\DataSource;

    class Reset extends DataSource {      

        function validateKey($key, $email, $action) {
            if ($action == "reset"){
                $curDate = date("Y-m-d H:i", time());
                try{
                    $query = "SELECT * FROM `password_reset_temp` WHERE `key`='$key' and `email`='$email'";
                    $row = $this->getRecordCount($query, 'ss');
                    if ($row > 0) {                        
                        $row = $this->select($query, 'ss');       
                        $expDate = $row[0]['expDate'];
                        $expDate = strtotime($expDate);
                        $expDate = date("Y-m-d H:i", $expDate);
                        if ($expDate >= $curDate){
                            return "Key is valid";
                        }else{
                            throw new Exception("Key has Expired");
                        }
                    }else{
                        throw new Exception("Invalid Key");
                    }
                }catch(Exception $e){
                    return $e->getMessage();
                }
            }
        }
        function changePassword($email, $password) {
            $securepass = $this->securePass($password);
            $query = "UPDATE users SET password='$securepass' WHERE user_email = '$email'";
            try{
                $this->execute($query, 'ss');
                $query = "DELETE FROM `password_reset_temp` WHERE email = '$email'";
                $this->execute($query, 's');
                return "Password Reset Successful..Please Login";
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
        private function securePass($password) {
            $salt = 'uliza2023.';
            $password1 = md5($password);
            return $salt.$password1;
        }
    }

$Reset = new Reset;
header('Content-Type: application/json');

if ( isset($_GET['validateKey']) ) {
    if ( isset($_GET['key']) && !empty($_GET['key']) && isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['action']) && !empty($_GET['action']) ) {
        $key = $_GET['key'];
        $email = $_GET['email'];
        $action = $_GET['action'];
        $response = $Reset->validateKey($key, $email, $action);
        echo $response;

    }else{
        echo "Empty Request";
    }

}
if ( isset($_GET['changePassword']) ) {
    if ( isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['password']) && !empty($_GET['password']) ) {
        $email = $_GET['email'];
        $password = $_GET['password'];
        $response = $Reset->changePassword($email, $password);
        echo $response;
    }else{
       echo "Empty Request";
    }
}

?>