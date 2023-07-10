<?php 
session_start();
  if ( isset($_SESSION['msg']) ) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <link href="dist/img/help.png" rel="icon" type="image">
	<title>Uliza FLOW | Login</title>
	<!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="./dist/css/extra.css">
</head>


<body class="hold-transition login-page default-page">
  <div class="login-box">
  <div class="login-logo">
    <img src="dist/img/help.png" height="150px"/><br>
    <a><b>Uliza </b>FLOW</a>
  </div>
  <!-- /.login-logo -->
  <?php 
    if ( isset($msg) ) { ?>
      <p class="login-box-msg" style="color:red;"><?=$msg; ?></p><?php 
    } ?>
	<div class="card">
    <div class="card-body login-card-body the-default-card">     
      <p class="login-box-msg pb-5 " style="font-size: 20px;">Sign in to start your session</p>
      <form method="post" action="backend/auth/login/?login">
        <div class="input-group mb-4 input-group-field">
          <input name="username" class="form-control" placeholder="Username/Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope email-icon"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 input-group-field ">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock password-icon"></span>
            </div>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember-me">
              <label for="remember-me">Remember Me</label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="login" class="btn  btn-block  default-button">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1 pt-5">
        <span class="fas fa-question-circle text-white forgot-password-icon"></span>
        <a href="forgot-password/" class="text-white default-form-links">Forgot my password</a>
      </p>
      <p class="mb-0 pb-5 pt-3">
        <span class="fa fa-check-square text-white forgot-password-icon"></span>
        <a href="register.php" class="text-center text-white default-form-links">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<div class="footer pt-5">

               <div class="row  pt-5 ">

                    <div class="low text-center col-5 mr-0"> <a href="">Terms of service</a></div>
                    <div class="text-center col-2"> | </div>
                    <div class="low text-center col-5 ml-0"> <a href="">Privecy policy </a></div>

                </div>
          
</div>
</body>
</html>