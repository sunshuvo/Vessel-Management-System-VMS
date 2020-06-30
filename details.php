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
<title>Fisharies Details</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/details.css">
</head>

	

<body>
	<!--Heading Start-->
	<header>
		<div class="container">
			<div class="logo">
				<img src="img/logo.jpg" alt="">
			</div>
			<div class="menu">
				<ul>
					<li><a href="index.php">Live View</a></li>
					<li class="page_active"><a href="details.php">Details</a></li>
					<li><a href="user.php">User</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!--Heading End-->
	<body>
		<section class="details">
			<div class="container">
				
				<aside class="details_menu">
					<ul>
						<li><a href="approve.php">Approve</a></li>
						<li><a href="active.php">Active</a></li>
						<li><a href="history.php">History</a></li>
					</ul>
				</aside>
				
				<section class="details_body">
					
				</section>
			</div>
		</section>
	</body>
	
	<!--Footer Start-->
	<footer>
		<div class="container">
			<address>
				some address, inside dhaka, Bangladesh
			</address>
			
			<div class="footer_link">
				<ul>
					<li><a href="#">Link1</a></li>
					<li><a href="#">Link2</a></li>
					<li><a href="#">Link3</a></li>
					<li><a href="#">Link4</a></li>
				</ul>
			</div>
		</div>
	</footer>
	<!--Footer End-->
</body>
</html>