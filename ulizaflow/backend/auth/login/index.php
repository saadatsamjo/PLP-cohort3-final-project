<?php 
    require_once('../../conn/db.php');
    use UlizaFLOW\DbConnectAPI\DataSource;
    session_start();
    class Login extends DataSource {

        function login($username, $password){            
            $securepass = $this->securePass($password);
            try{
                $query = "SELECT * FROM users WHERE (username ='$username' OR user_email ='$username') AND password='$securepass'";
                $count = $this->getRecordCount($query, 'ss');
                if($count > 0){
                    $row = $this->select($query, 'ss');
                    $_SESSION['id']=$row[0]['user_id'];
                    $_SESSION['username']=$row[0]['username'];
                    $_SESSION['email']=$row[0]['user_email'];
                    $_SESSION['profilepic']=$row[0]['profilepic'];
                    $_SESSION['userIsLoggedIn']=true;
                    $query = "UPDATE `users` SET `status`='Online' WHERE username='$username'";
                    $this->execute($query, 's');
                    return "Authorized";         
                }else{
                    throw new Exception("The entered credentials do not match any user");
                }
            }catch(Exception $err){
                return $err->getMessage();
            }

        }
        private function securePass($password) {
            $salt = 'uliza2023.';
            $password1 = md5($password);
            return $salt.$password1;
        }
        /*private function setCookie($username) {
            
        }*/

    }
    
$Login = new Login;
header('Content-Type: application/json');
if( isset($_GET['login']) && !empty($_POST)) {    
    $username  = $_POST['username'];
    $password = $_POST['password'];
    $response = $Login->login($username, $password);
    if($response == "Authorized"){
        header('location:../../../account/');
    }else{
        $_SESSION['msg'] = $response; 
        header('location:../../../');
    }
}else{
    echo "Empty Request";
}  
?>