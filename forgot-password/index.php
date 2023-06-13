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
  <link href="../dist/img/help.png" rel="icon" type="image">
	<title>ULIZAFLOW 2023 | Reset Password</title>
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
    <div class="card-body login-card-body">     
      <p class="login-box-msg">You forgot your password? <br>We get it, stuff happens. Just enter your email address below
        and we'll send you a link to reset your password!</p>
      <form method="post" action="send-token.php">
        <div class="input-group mb-3">
          <input type="email" name="useremail" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" id="login" class="btn btn-primary btn-block">Send</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="../">Back to Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</body>
</html>