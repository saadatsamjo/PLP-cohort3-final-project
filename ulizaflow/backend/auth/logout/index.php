<?php
	require_once('../../conn/db.php');
    use UlizaFLOW\DbConnectAPI\DataSource; 
    session_start();
    class Logout extends DataSource {
        private function changeStatus($userid) {
            try{
                $query = "UPDATE users SET status = 'Offline' WHERE user_id = '$userid'";
                $this->execute($query, 'i');
            }catch(Exception $err){
                return $err->getMessage();
            }
        }
        function killSession($userid) {
            $this->changeStatus($userid);
            session_destroy();            
            return "User Logged Out";
        }
    }
$Logout = new Logout;
header('Content-Type: application/json');

if(isset($_GET['endSession'])) {
    $userid = $_GET['endSession'];
    $response = $Logout->killSession($userid);
    echo $response;
}
?>