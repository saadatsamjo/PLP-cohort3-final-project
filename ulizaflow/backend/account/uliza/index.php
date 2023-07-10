<?php 
    require_once('../../conn/db.php');
    use UlizaFLOW\DbConnectAPI\DataSource;

    class Uliza extends DataSource {

    	function checkTitle($value) {
	    	$title = $value;
	    	$query = "SELECT thread_title,thread_id FROM `threads` WHERE (`thread_title` LIKE '{$title}')";
	    	$result = $this->select($query, 's');
	    	if (is_array($result) && $result != null) {
				return json_encode($result[0]);
	    	}else{
	    		return "OK";
	    	}
    	}
    	function askQuestion($title, $description, $user_id, $category_id) {
    		/*try{
    			$query = "INSERT INTO `threads`(`thread_title`, `thread_desc`, `thread_cat_id`, `user_id`) VALUES ('$title','{$description}','$category_id','$user_id')";//ON DUPLICATE KEY UPDATE `email` = '$useremail', `key` = '$key', `expDate` = '$expDate'";		
				$this->execute($query, 'ssii');
				$query = "";
				$result = $this->getRecordCount($query, 'ssii');
		        if($this->execute($query, 'ssii')){
		        	return "Your Question has been asked";
		        }else{
		            throw new Exception("An error occured try again");
		        }
		    }catch(Exception $err){
		        return $err;//->getMessage();
		    }*/

    	}
    	function updateQuestion($title, $description, $user_id, $category_id) {

    	}

    }

$Uliza = new Uliza;
header('Content-Type: application/json');
?>