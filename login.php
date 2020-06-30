<?php
require("function/session.php");
require("function/function.php");
$username="";

$connect=mysql_conn();
$dbtable="user";

if(isset($_POST["submit"]) && $_POST["username"]=="admin"){

	$username = $_POST["username"];
	$password = $_POST["password"];
	
		
	if(passcheck($username,$password)){
		echo "<h2>user pass matched</h2>";
		$_SESSION["username"] = findentry($username,"username");
		redirect_to("index.php");

	}
	else {echo "<h2>Wrong Credential.... Please try Again</h2>";};
	
}

//if($connect){echo "Mysql Connected...";}
//else{die();}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fisharies Admin</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/login.css">
</head>

	

<body onload="getLocation()">
	<!--Heading Start-->
	<header>
		<div class="container">
			<div class="login_logo">
				<img src="img/logo.jpg" alt="">
			</div>
			
		</div>
	</header>
	<!--Heading End-->
	<section class="admin_login">
		<div class="field">
				<ul>
					<form action="login.php" method="post">
					<li>
						<label for="user">Username:</label> <input id="user" type="text" name="username" value="<?php echo $username;?>" placeholder="Enter Username">
					</li>
					<li>
						<label for="password">Password:</label> <input id="password" type="password" name="password" value="" placeholder="Enter password">
					</li>
					<li>
						<input type="submit" name="submit" value="Login">
					</li>
					</form>
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
	<script src="js/script.js"></script>
</body>
</html>