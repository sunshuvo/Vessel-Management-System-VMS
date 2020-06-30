<?php
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}
	$dbtable="field_input";
	$dbtable_check="trip";
	$connect=mysql_conn();

	if(isset($_POST["submit"]) && $_POST["submit"]=="Update"){
		if(isset($_SESSION["username"])){$update_user=$_SESSION["username"];}
		$update_latitude=$_POST["latitude"];
		$update_longitude=$_POST["longitude"];
		$update_type=$_POST["fish_type"];
		$update_weight=$_POST["weight"];
		$update_message=$_POST["message"];
		
		$row_query_existing_trip  = "select * from $dbtable_check ";
		$row_query_existing_trip .= "Where trip_username='$update_user' ";
		$row_query_existing_trip .= "and status=1";

		$row_existing_trip_res = mysqli_query($connect,$row_query_existing_trip);
		$existing_trip = mysqli_fetch_assoc($row_existing_trip_res);
		
		$current_trip = $existing_trip["id"];
		
		
		if(mysqli_num_rows($row_existing_trip_res)==1){
			if(!empty($update_user) && !empty($update_type) && !empty($update_weight)){
				$update_user=mysqli_real_escape_string($connect, $update_user);
				$update_latitude=mysqli_real_escape_string($connect, $update_latitude);
				$update_longitude=mysqli_real_escape_string($connect, $update_longitude);
				$update_type=mysqli_real_escape_string($connect, $update_type);
				$update_weight=mysqli_real_escape_string($connect, $update_weight);
				$update_message=mysqli_real_escape_string($connect, $update_message);

				$insert  = "insert into $dbtable ";
				$insert .= "(trip_id, username, latitude, longitude, fish_type, weight, messsage) values ";
				$insert .= "('$current_trip', '$update_user', '$update_latitude', '$update_longitude','$update_type', '$update_weight', '$update_message')";

				$qry_insert = mysqli_query($connect,$insert);

				if($qry_insert && mysqli_affected_rows($connect)==1){
					echo "<span style=\"color:green;\">Updated Successfully. Please Wait for Confirmation<br></span>";
				}
				else{
					echo $insert."<br>";

				}
			}
			else{
				echo "<span style=\"color:red;\">Field can't be empty. Please enter again<br></span>";
			}
		}
		else{
			echo "Currently your are not in trip.";
		}
	}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fisharies Admin</title>
<link rel="stylesheet" href="css/style.css">
</head>

	

<body onload="getLocation()">
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
					<form action="input.php" method="post">
					<input id="get_latitude" type="hidden" name="latitude">
					<input id="get_longitude" type="hidden" name="longitude">
					<li>
						<label for="type">Fish Name:</label> <input id="type" type="text" name="fish_type" value="" placeholder="Enter Fish Name">
					</li>
					<li>
						<label for="weight">Daily Weight:</label> <input id="weight" type="text" name="weight" value="" placeholder="Enter Weight">
					</li>
					<li>
						<label for="message">Message:</label> <input id="message" type="text" name="message" value="" placeholder="Enter Your message">
					</li>
					<li>
						<input type="submit" name="submit" value="Update">
					</li>
					</form>
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
	<script src="js/script.js"></script>
</body>
</html>