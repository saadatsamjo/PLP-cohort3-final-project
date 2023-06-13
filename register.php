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
</head>
<body class="hold-transition login-page">
  <div class="register-box">
  <div class="register-logo">
    <img src="dist/img/help.png" height="100px"/><br>
    <a><b>Uliza</b> FLOW</a>
  </div>
  <!-- /.register-logo -->
  <div class="card">
  <div class="card-body register-card-body">
  <div class="bs-stepper linear">
          <div class="bs-stepper-header" role="tablist">
            <!-- your steps here -->
            <div class="step active" data-target="#logins-part">
              <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger" aria-selected="true">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Personal Info</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#information-part">
              <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Account info</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content">
            <!-- your steps content here -->
            <div id="logins-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="logins-part-trigger">
<!--Our 1st code start here-->
              <div class="input-group mb-3">
                <input type="email" class="form-control" id="email" placeholder="Email" onkeyup="checkUser(email)" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="number" class="form-control" id="contact" placeholder="Phone Number" onkeyup="checkUser(contact)" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
   <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" placeholder="D.O.B (dd/mm/yyyy)" id="dob"><div class="input-group-append">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="gender">
                  <label class="form-check-label">Male</label>
                <br>
                  <input class="form-check-input" type="radio" id="gender">
                  <label class="form-check-label">Female</label>
                </div>
              </div>
<!--Our 1st code ends here-->

              <button class="btn btn-primary" onclick="stepper.next()">Next</button>
              <p class="mb-0">
        <a href="index.php" class="text-center">Already have an account</a>
      </p>
            </div>
            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">

              <div class="input-group mb-3">
                <input type="text" class="form-control" id="username" placeholder="User Name" onkeyup="checkUser(username)" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" id="password1" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" id="password2" placeholder="Retype password" onkeyup="comparePass()">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>

              <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
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
  $('#dob').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
})
</script>
</body>
</html>