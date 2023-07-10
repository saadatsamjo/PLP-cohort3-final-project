<?php 
date_default_timezone_set("Africa/Nairobi");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <link href="../dist/img/help.png" rel="icon" type="image">
	<title>Uliza FLOW | Reset Password</title>
	<!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
  <div class="login-logo">
    <img src="../dist/img/help.png" height="150px"/><br>
    <a><b>Uliza </b>FLOW</a>
  </div>
  <!-- /.login-logo -->
  <?php 
    if ( isset($msg) ) { ?>
      <p class="login-box-msg" style="color:red;"><?=$msg; ?></p><?php 
    } ?>
	<div class="card">
    <div class="card-body login-card-body"> <?php
            require('../conn/db.php');
            use DbConnectAPI\DataSource;
            $con = new DataSource;
            if ( isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset" && !isset($_POST["action"])) ){
                $key = $_GET["key"];
                $email = $_GET["email"];
                $curDate = date("Y-m-d H:i", time());
                try{
                    $query = "SELECT * FROM `password_reset_temp` WHERE `key`='$key' and `email`='$email'";
                    $row = $con->getRecordCount($query, 'ss');
                    if ($row > 0) {                        
                        $row = $con->select($query, 'ss');       
                        if ( $row == null || $row < 1) {
                            $error = '<h2>Invalid Link</h2>
                        <p>The link is invalid/expired. Either you did not copy the correct link from the email, 
                        or the key has already been used in which case it is unauthorized.</p>
                        <a href="index.php"><p class="btn btn-primary btn-user btn-block">Click here to try again.</p></a>';
                            throw new Exception("<div class='error'>".$error."</div><br />");
                        }else{
                            $expDate = $row[0]['expDate'];
                            $expDate = strtotime($expDate);
                            $expDate = date("Y-m-d H:i", $expDate);
                        }
                        if ($expDate >= $curDate){ ?>                
                            <p class="login-box-msg">You are only one step away from recovering your account, enter a new password.</p>
                            <form method="post">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" id="pass1" placeholder="Password" maxlength="20" required autocomplete="new-password" onkeyup="passwordChecker();">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div><small id="password_status"></small>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="pass2" placeholder="Confirm Password" maxlength="20" autocomplete="new-password" required onkeyup="validatePassword();">
                                    <input type="hidden" name="email" id="email" value="<?php echo htmlentities($email);?>"/>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div><small id="confirm_status"></small>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" name="change" id="send" class="btn btn-primary btn-block">Change password</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <?php 
                                if ( isset($_POST['change']) ){
                                    $useremail = $_POST['email'];
                                    $password0 = $_POST['password'];
                                    $salt = 'uliza2023.';
                                    $password1 = md5($password0);
                                    $password = $salt.$password1;
                                    $query = "UPDATE users SET password='$password' WHERE user_email = '$useremail'";
                                    $con->execute($query, 'ss');
                                    $query = "DELETE FROM `password_reset_temp` WHERE email = '$useremail'";
                                    $con->execute($query, 's');
                                    session_start();
                                    $_SESSION['msg'] = "Password Reset Successful..Please Login";
                                    header('location:../');
                                }
                            ?>
                            <p class="mt-3 mb-1">
                                <a href="../">Login</a>
                            </p> <?php   
                        }else{
                            $error = "<h3 style='color:gold'>Link Expired</h3>
                            <p>The link is expired. Please try again or contact support.<br /><br /></p>";
                            throw new Exception("<div class='error'>".$error."</div><br />");
                        }
                    }else{
                        $error = '<h2>Invalid Link</h2>
                            <p>The link is invalid/expired. Either you did not copy the correct link from the email, 
                            or the key has already been used in which case it is unauthorized.</p>
                            <a href="index.php"><p class="btn btn-primary btn-user btn-block">Click here to try again.</p></a>';
                                throw new Exception("<div class='error'>".$error."</div><br />");
                    }
                }catch(Exception $e){
                    echo $e->getMessage();
                    echo "<a href='index.php'> Try again</a>";
                    exit();
                }    
            } ?>        
        </div>
    <!-- /.login-card-body -->
  </div>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../dist/password-validation.js"></script>
</body>
</html>