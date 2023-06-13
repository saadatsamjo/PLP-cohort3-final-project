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
</head>
<body class="hold-transition login-page">
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
    <div class="card-body login-card-body">     
      <p class="login-box-msg">Sign in to start your session</p>
      <form method="post" action="account/login.php">
        <div class="input-group mb-3">
          <input name="username" class="form-control" placeholder="Username/Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember-me">
              <label for="remember">Remember Me</label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password/">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</body>
</html>