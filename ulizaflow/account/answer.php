<?php 
	require_once('../conn/db.php');
	use DbConnectAPI\DataSource;
	$con = new DataSource;
	session_start();
	$question = $_POST['id'];
	$query = "SELECT * FROM `comments` WHERE question_id = $question" ORDER BY `rating` DESC;
	try{
		$result = $con->select($query, 'i');
        if($result){
	    	$data['answerId'] = $result[0]['answer_id'];
	    	$data['questionId'] = $result[0]['question_id'];
	    	$data['answer'] = $result[0]['answer_desc'];
	    	$data['user_id'] = $result[0]['user_id'];
	    	$data['categoryId'] = $result[0]['categoryId'];
	    	$data['rating'] = $result[0]['rating'];
	    	echo json_encode($data);
    	}else{
    		throw new Exception("An error occured while fetching answers...Try again");
    	}

	}catch(Exception $err){
        echo $err->getMessage();
        //header('location:index.php');
    }

?>