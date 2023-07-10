<?php 
require_once('checklogin/index.php');
//require_once('logout/index.php');
require_once('../conn/db.php');
use UlizaFLOW\DbConnectAPI\DataSource;    
    
class UserDashboard extends DataSource {
  function getCategories(){
    $query = "SELECT * FROM `categories`";
    try{
      $rows = $this->select($query);
      return json_encode($rows);
    }catch(Exception $err){
      return $err->getMessage();
    }
  }
  function getCategory($id){
    $query = "SELECT * FROM `categories` WHERE category_id = '$id'";
    try{
      $rows = $this->select($query, 'i');
      return json_encode($rows);
    }catch(Exception $err){
      return $err->getMessage();
    }
  }
} 

//$checkLogin = new checkLogin;
//$userAuth = $checkLogin->select();
$userAuth = 'Authenticated';
header('Content-Type: application/json');

if ( $userAuth == 'Authenticated' ){
  $UserDashboard = new UserDashboard;
  if (isset($_GET['allCategories']) ) {
    $response = $UserDashboard->getCategories();
    echo $response;
  }
  if (isset($_GET['category']) ) {
    if (!empty($_GET['category']) ) {
      $id = $_GET['category'];
      $response = $UserDashboard->getCategory($id);
      echo $response;
    }else{
      echo "Empty Request";
    }
  }
  
}else{
  //exit(); /**Send to Login Page
}

?>