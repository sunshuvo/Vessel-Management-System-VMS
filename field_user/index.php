<?php 
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fisharies Admin</title>
<link rel="stylesheet" href="css/style.css">
</head>

	

<body>
	<!--Heading Start-->
	<header>
		<div class="container">
			<div class="logo">
				<img src="img/logo.jpg" alt="">
			</div>
			
		</div>
	</header>
	<!--Heading End-->
	<section class="mobile_menu">
		<div class="menu">
				<ul>
					<a href="index.php"><li>Index</li></a>
					<a href="request.php"><li>Request Trip</li></a>
					<a href="input.php"><li>Input Data</li>
					<a href="view.php"><li>View</li></a>
					<a href="logout.php"><li>Logout</li></a>
				</ul>
			</div>
	</section>
		<!--Footer Start-->
	<footer>
		<div class="container">
			<address>
				some address, inside dhaka, Bangladesh
			</address>
		</div>
	</footer>
	<!--Footer End-->
</body>
</html>