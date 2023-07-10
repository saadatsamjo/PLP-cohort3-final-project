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
	<title>Uliza FLOW | Register</title>
	<!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./dist/css/extra.css">
</head>
<body class="hold-transition login-page">
  <div class="register-box">
  <div class="register-logo">
    <img src="dist/img/help.png" height="100px"/><br>
    <a><b>Uliza</b> FLOW</a>
  </div>
  <!-- /.register-logo -->
  <?php 
    if ( isset($msg) ) { ?>
      <p class="login-box-msg" style="color:red;"><?=$msg; ?></p><?php 
    } ?>
  <div class="card">
  <div class="card-body register-card-body the-default-card">
  <div class="bs-stepper linear">
    <form method="POST" action="account/register.php">
          <div class="text-center"><h5> Personal info.</h5></div>
          <div class="bs-stepper-content">
            <!-- your steps content here -->
            <div id="logins-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="logins-part-trigger">
<!--Our 1st code start here-->
                
              <div class="row full-name-row mt-4">
                    <div class="input-group-field input-group flex-nowrap col-5 ml-2 bg-white">
                      
                      <input type="text" class="form-control border-0" placeholder="First name" aria-label="First-name" id="First-name" aria-describedby="addon-wrapping">
                    </div>

                    <div class="input-group-field input-group flex-nowrap col-5 mr-2 bg-white">
                      
                      <input type="text" class="form-control border-0" placeholder="Second name" aria-label="Second-name" id="Second-name" aria-describedby="addon-wrapping">
                    </div>

              </div>  

              <small id="email_status"></small><br id="email-break">
              <label for="email">Email :</label>
              <div class="input-group mb-3 default-email-input">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" onkeyup="checkUser(email)" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope email-icon"></span>
                  </div>
                </div>
              </div>
                <label for="dob">Date of Birth :</label>
              <div class="input-group mb-3 default-email-input">
   <input type="text" class="form-control" name="dob" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask="" inputmode="numeric" placeholder="D.O.B (yyyy/mm/dd)" id="dob"><div class="input-group-append" required>
                  <span class="input-group-text calendar-icon"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
<!--Our 1st code ends here-->

            <button class="btn btn-primary default-button" id="next" onclick="stepper.next()">Next</button>
            <p class="mb-4 mt-4">
              <i class="fa fa-arrow-circle-left text-white"></i>
              <a href="index.php" class="text-center text-white default-form-links">Already have an account</a>
            </p>
            </div>
            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
              <label for="username">Username :</label>
              <div class="input-group mb-3">                
                <input type="text" class="form-control" id="username" name="username" placeholder="User Name" onkeyup="checkUser(username);" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div><small id="username_status"></small><br id="username-break">
              <label for="pass1">Password :</label>
              <div class="input-group mb-3">                
                <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Password" required onkeyup="passwordChecker();">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <small id="password_status"></small><br id="password-break">
              <label for="pass2">Repeat Password :</label>
              <div class="input-group mb-3">                
                <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Retype password" onkeyup="validatePassword();" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
              <button type="submit" id="send" class="btn btn-primary">Submit</button>
              </div>
          </div>
        </form>
        </div>
  
    <!--/.register-card-body -->
  </div>
</div>
<?php include('scripts.php');?>
<!-- Bs stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  $('#dob').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })
})
</script>
<script src="dist/password-validation.js"></script>
</body>
</html>