<?php 
	require_once('../../conn/db.php');
	use UlizaFLOW\DbConnectAPI\DataSource;

	session_start();

	class Thread extends DataSource {
		function fetchall($id) {
			$query = "SELECT threads.thread_id,threads.thread_title,threads.thread_desc,threads.thread_cat_id,threads.date_posted,threads.date_updated,threads.user_id,threads.status,users.user_id,users.username FROM `threads` LEFT JOIN `users` ON users.user_id = threads.user_id WHERE thread_cat_id = $id ";
			try{
		        $count = $this->getRecordCount($query, 'i');
		        if ($count > 0) {
					$questions = $this->select($query, 'i');
			        if($questions){
			        	return json_encode($questions);
			        }else{
			        	throw new Exception("An error occured while fetching questions...Try again");
			        }
		        }else{
		        	return json_encode("None");
		        }
		    }catch(Exception $err){
		        return $err->getMessage();
		    }
		}
		function existing($id) {
			$query = "SELECT threads.thread_id,threads.thread_title,threads.thread_desc,threads.thread_cat_id,threads.date_posted,threads.date_updated,threads.user_id,threads.status,users.username FROM `threads` LEFT JOIN `users` ON users.user_id = threads.user_id WHERE thread_id = $id ";
			try{
				$result = $this->select($query, 'i');
				if($result){
					return json_encode($result);
				}else{
		    		throw new Exception("An error occured while fetching questions...Try again");
		    	}
			}catch(Exception $err){
		        return $err->getMessage();
		    }
		}
		function fetchAllQuiz() {
			$query = "SELECT threads.thread_id,threads.thread_title,threads.thread_desc,threads.thread_cat_id,threads.date_posted,threads.date_updated,threads.status,threads.user_id,users.username FROM `threads` LEFT JOIN `users` ON users.user_id = threads.user_id ";
			try{
				$count = $this->getRecordCount($query, 'i');
		        if ($count > 0) {
					$result = $this->select($query);
					if($result){
						return json_encode($result);		    		
			    	}else{
			    		throw new Exception("An error occured while fetching questions...Try again");
			    	}
			    }else{
		        	return json_encode("None");
		        }
			}catch(Exception $err){
		        return $err->getMessage();
		    }
		}
		function checkTitle($title) {
			$query = "SELECT thread_id FROM `threads` WHERE (`thread_title` LIKE '{$title}')";
			$result = $this->select($query, 's');
			if (is_array($result) && $result != null) {
				return json_encode($result[0]);
			}else{
				return json_encode("OK");
			}
		}
		
	}


$Thread = new Thread;
header('Content-Type: application/json');

if (isset($_GET['existing']) ) {
	if (!empty($_GET['existing'])) {
		$id = $_GET['existing'];
		echo $Thread->existing($id);
	}else{
	    echo "Empty Request";
	}
}
if (isset($_GET['fetchAll']) ) {
	if (!empty($_GET['fetchAll']) ) {
		$id = $_GET['fetchAll'];
		echo $Thread->fetchall($id);
	}else{
	    echo "Empty Request";
	}
}
if (isset($_GET['fetchAllQuiz']) ) {
	echo $Thread->fetchAllQuiz();
}
if (isset($_GET['checktitle'])) {
	if (!empty($_POST['value'])) {
		$title = $_POST['value'];
		echo $Thread->checkTitle($title);
	}else{
	    echo "Empty Request";
	}
}
if (!isset($_GET) ) {
	echo "Empty Request";
}

?>