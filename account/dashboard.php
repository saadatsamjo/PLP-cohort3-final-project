<?php 
require_once('checklogin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UlizaFlow User Dashboard</title>
</head>
<body>
	<nav>
		<ul>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<?php
	if ( isset($_SESSION['msg']) ) {
		$msg = $_SESSION['msg'];
		unset($_SESSION['msg']);
		echo $msg; 
	} 
	?>

</body>
</html>