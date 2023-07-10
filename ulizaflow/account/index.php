<?php 
require_once('checklogin.php');
if ( isset($_SESSION['msg']) ) {
	$msg = $_SESSION['msg'];
	unset($_SESSION['msg']);
	echo $msg; 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/img/help.png" rel="icon" type="image">
	<title>UlizaFlow User Dashboard</title>
	<!-- Google Font: Source Sans Pro -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  	<!-- Font Awesome Icons -->
  	<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/extra.css">
  	<!-- overlayScrollbars -->
  	<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">    
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="sidebar-mini layout-fixed">
	<div class="wrapper">
	<?php include('../extras/navbar.php'); ?>
	<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../dist/img/help.png" alt="UlizaFLOW Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Uliza FLOW</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">PUBLIC</li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../account/" class="nav-link active">
                  <i class="fas fa-home nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="questions/" class="nav-link">
                  <i class="fas fa-question nav-icon"></i>
                  <p>Questions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tags/" class="nav-link">
                  <i class="fas fa-tags nav-icon"></i>
                  <p>Tags</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="users/" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside> 
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row" id="row"></div>
        <div class="modal fade" id="answer-question">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Uliza a Question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" id="ulizaQuestion">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="title">Question Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter your question" onkeyup="checkQuestion()">
                    <input type="hidden" id="user_id" name="user_id" value="<?=$_SESSION['id']; ?>">
                    <small id="titleHelp" class="form-text text-muted">Keep the title as simple as possible.</small>
                  </div>
                  <div class="form-group" id="desc">
                    <label for="description">Question Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" rows="3" placeholder="Enter a description of your problem"></textarea>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" id="postQuestion" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('../extras/footer.php'); ?>
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include('../extras/scripts.php'); ?>
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
</script>
<script src="js/dashboard.js"></script>
</body>
</html>