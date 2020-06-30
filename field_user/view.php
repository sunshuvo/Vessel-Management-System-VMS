<?php
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}
	$dbtable_trip="trip";
	$dbtable_request="trip_request";
	$dbtable_field="field_input";
	$connect=mysql_conn();
	
	if(isset($_SESSION["username"])){$update_user=$_SESSION["username"];}
	
	if(!empty($update_user)){
		$existing_trip  = "select * from $dbtable_trip ";
		$existing_trip .= "Where trip_username='$update_user' ";
		$existing_trip .= "and status=1";

		$existing_trip_res = mysqli_query($connect,$existing_trip);
		$existing_trip_array = mysqli_fetch_assoc($existing_trip_res);
		
		$total_weight = $existing_trip_array["current_weight"];
	}
	else{
		$total_weight=0;
	}
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
		<div class="field">
				<ul>
					<li>Current Location</li>
					<li>Day Count</li>
					<li>Day Remian</li>
					<li>Total Weight: <?php echo $total_weight;?></li>
					<li>Remaining Weight</li>
					<a href="index.php"><li>Back</li></a>
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