<?php 
    require_once('../conn/db.php');
    use DbConnectAPI\DataSource;
    $con = new DataSource;
    session_start();
    
    if (isset($_GET['checktitle'])) {
    	$title = $_POST['value'];
    	$query = "SELECT thread_title,thread_id FROM `threads` WHERE (`thread_title` LIKE '{$title}')";
    	$result = $con->select($query, 's');
    	if (is_array($result) && $result != null) {
			echo json_encode($result[0]);
    	}else{
    		echo "OK";
    	}
    	
    }

    /*
	$title = $_POST['title'];
	$description = $_POST['description'];
	$user_id = $_POST['user_id'];
	$category_id = $_POST['category_id'];
	
	$query = "INSERT INTO `threads`(`thread_title`, `thread_desc`, `thread_cat_id`, `user_id`) VALUES ('$title','{$description}','$category_id','$user_id')";
	//ON DUPLICATE KEY UPDATE `email` = '$useremail', `key` = '$key', `expDate` = '$expDate'";
	try{		
		$con->execute($query, 'issii');
		$query = "";
		$result = $con->getRecordCount($query, 'ssii');
        if($con->execute($query, 'ssii')){
        	echo "Your Question has been asked";
        }else{
            throw new Exception("An error occured try again");
        }
    }catch(Exception $err){
        echo $err;//->getMessage();
    }*/
?>