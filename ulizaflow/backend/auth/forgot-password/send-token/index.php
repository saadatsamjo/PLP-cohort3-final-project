<?php 
    require_once('../../../conn/db.php');
    require('../../vendor/PHPMailer/PHPMailerAutoload.php');
    use UlizaFLOW\DbConnectAPI\DataSource;
    date_default_timezone_set("Africa/Nairobi");

    session_start();

    class ForgotPassword extends DataSource {
    	function checkEmail($useremail) {
    		$query = "SELECT user_email FROM users WHERE user_email='$useremail'";
    		try{
    			$count = $this->getRecordCount($query, 's');
		        if ($count > 0) {
		        	return "Email OK";
		        }else{
		        	throw new Exception("The entered email is not linked to any account");
		        }
		    }catch(Exception $err){
		        return $err->getMessage();
		    }
    	}
    	private function generateToken($useremail) {
		    $expDate = date("Y-m-d H:i", time() + 1800); 
		    $key0 = md5((2418*2).$useremail);
		    $addKey = substr(md5(uniqid(rand(),1)),3,10);
		    $key = $key0 . $addKey;

		    try{
		    	$query = "INSERT INTO `password_reset_temp`(`email`, `key`, `expDate`) VALUES('$useremail', '$key', '$expDate')
			     ON DUPLICATE KEY UPDATE `email` = '$useremail', `key` = '$key', `expDate` = '$expDate'";
			    $this->execute($query, 'sss');
			    return $key;

		    }catch(Exception $err){
		        return $err->getMessage();
		    }
    	}
    	function sendEmail($fromserver, $email_to){
    		$key = $this->generateToken($email_to);
    		$output='<p>Dear user,</p>';
			$output.='<p>Please click the button below to reset your password.</p>';
			$output.='<p>-------------------------------------------------------------</p>';
			$output.='<p><a href="'.BASE_URL.'/forgot-password/reset-password.php?key='.$key.'&email='.$email_to.'&action=reset" target="_blank">Reset Password</a></p>';		
			$output.='<p>-------------------------------------------------------------</p>';
			$output.='<p>You can also copy the link below to your browser</p>';
			$output.='<p>-------------------------------------------------------------</p>';
			$output.='<p><a href="'.BASE_URL.'/forgot-password/reset-password.php?key='.$key.'&email='.$email_to.'&action=reset" target="_blank">'.BASE_URL.'/forgot-password/reset-password.php?key='.$key.'&email='.$email_to.'&action=reset</a></p>';
			$output.='<p>-------------------------------------------------------------</p>';
			$output.='<p>Please be sure to copy the entire link into your browser.
			    The link will expire after 30 minutes for security reasons.</p>';
			$output.='<p>If you did not request this password reset email, no action 
			    is needed, your password will not be reset. However, you may want to log into 
			    your account and change your security password as someone may have guessed it.</p>';   	
			$output.='<p>Thanks,</p>';
			$output.='<p>UlizaFLOW Support Team</p>';
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
		    $mail->Subject = "Password Recovery";
		    $mail->Body = $output;
		    $mail->AddAddress($email_to);

		    if( !$mail->Send() ){
		    	return "Mailer Error...Please try again";
		    }else{
		        return "Mail Successfully Sent";
		    }

    	}
    }

$ForgotPassword = new ForgotPassword;
header('Content-Type: application/json');

if ( isset($_GET['checkEmail']) ) {
    if ( isset($_GET['email']) && !empty($_GET['email']) ) {
        $useremail = $_GET['email'];
        $response = $ForgotPassword->checkEmail($useremail);
        echo $response;

    }else{
        echo "Empty Request";
    }

}
if ( isset($_GET['sendEmail']) ) {
    if ( isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['fromserver']) && !empty($_GET['fromserver']) ) {
        $email_to = $_GET['email'];
        $fromserver = $_GET['fromserver'];
        $response = $ForgotPassword->sendEmail($fromserver, $email_to);
        echo $response;
    }else{
       echo "Empty Request";
    }
}
?>