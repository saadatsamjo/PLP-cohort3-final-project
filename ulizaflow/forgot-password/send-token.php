<?php 
    require_once('../conn/db.php');
    use DbConnectAPI\DataSource;
    date_default_timezone_set("Africa/Nairobi");
    $con = new DataSource;
    session_start();

    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	if(isset($_POST['useremail'])){
		$useremail = $_POST['useremail'];
		try{
	        $query = "SELECT user_email FROM users WHERE user_email='$useremail'";//  

	        $count = $con->getRecordCount($query, 's');
	        if ($count > 0) {
	            $row = $con->select($query, 's'); 
			    $expDate = date("Y-m-d H:i", time() + 1800); 
			    $key = md5((2418*2).$useremail);
			    $addKey = substr(md5(uniqid(rand(),1)),3,10);
			    $key = $key . $addKey;

			    // Insert Temp Table
			    $query = "INSERT INTO `password_reset_temp`(`email`, `key`, `expDate`) VALUES('$useremail', '$key', '$expDate')
			     ON DUPLICATE KEY UPDATE `email` = '$useremail', `key` = '$key', `expDate` = '$expDate'";
			    $con->execute($query, 'sss');

			    $output='<p>Dear user,</p>';
			    $output.='<p>Please click this button to reset your password.</p>';
			    $output.='<p>-------------------------------------------------------------</p>';
			    $output.='<p><a href="'.BASE_URL.'/forgot-password/reset-password.php?key='.$key.'&email='.$useremail.'&action=reset" target="_blank">Reset Password</a></p>';		
			    $output.='<p>-------------------------------------------------------------</p>';
			    $output.='<p>You can also copy the link below to your browser</p>';
			    $output.='<p>-------------------------------------------------------------</p>';
			    $output.='<p><a href="'.BASE_URL.'/forgot-password/reset-password.php?key='.$key.'&email='.$useremail.'&action=reset" target="_blank">'.BASE_URL.'/forgot-password/reset-password.php?key='.$key.'&email='.$useremail.'&action=reset</a></p>';
			    $output.='<p>-------------------------------------------------------------</p>';
			    $output.='<p>Please be sure to copy the entire link into your browser.
			    The link will expire after 30 minutes for security reasons.</p>';
			    $output.='<p>If you did not request this password reset email, no action 
			    is needed, your password will not be reset. However, you may want to log into 
			    your account and change your security password as someone may have guessed it.</p>';   	
			    $output.='<p>Thanks,</p>';
			    $output.='<p>UlizaFLOW Support Team</p>';
			    $body = $output; 
			    $subject = "Password Recovery - UlizaFLOW";
			    $email_to = $useremail;
			    $fromserver = "ulizaflow@gmail.com";

			    
				    require('../vendor/PHPMailer/PHPMailerAutoload.php');
				    $mail = new PHPMailer();
				    $mail->IsSMTP();
				    $mail->Host = APP_MAIlHOST; //"127.0.0.1"; // Enter your mail host
				    $mail->SMTPAuth = true;
				    $mail->SMTPSecure = 'tls';         //Enable implicit TLS encryption
				    $mail->Port = 25;         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
				    $mail->Username = APP_CLIENTID; // GMAIL Client ID
				    $mail->Password = APP_CLIENTSECRET; //GMAIL Client Secret
				    $mail->IsHTML(true);
				    $mail->From = "ulizaflow@gmail.com";
				    $mail->FromName = "UlizaFLOW Dev Forum";
				    $mail->Sender = $fromserver; // indicates ReturnPath header
				    $mail->Subject = $subject;
				    $mail->Body = $body;
				    $mail->AddAddress($email_to);

				    if(!$mail->Send()){
				    	echo $body;
				        /*$class='class="alert alert-danger"';
				        $role='role="alert"';
				        echo "<div ".$class." ".$role.">Mailer Error...Please try again</div>";*/
				    }else{
				        $class='class="alert alert-success"';
				        $role='role="alert"';
				        echo "<div ".$class." ".$role.">
				        <p>A link has been sent to your email together with instructions on how to reset your password.</p>
				        <p>The link is valid for only 30 minutes.</p>
				        </div>";
				    }
	        } else {
	            throw new Exception("The entered email is not linked to any account");
	        }
	    }catch(Exception $err){
	        $_SESSION['msg'] = $err->getMessage();
	        header('location:index.php');
	    }
	}
?>