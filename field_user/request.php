<?php
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}
	$dbtable="trip_request";
	$dbtable_check="trip";
	$connect=mysql_conn();
	if(isset($_SESSION["username"])){$request_user=$_SESSION["username"];}
	if(isset($_POST["submit"]) && $_POST["submit"]=="Request"){
		if(isset($_SESSION["username"])){$request_user=$_SESSION["username"];}
		$request_day=$_POST["operation_days"];
		$request_passenger=$_POST["total_passengers"];
		
		$row_query_existing_trip  = "select * from $dbtable_check ";
		$row_query_existing_trip .= "Where trip_username='$request_user' ";
		$row_query_existing_trip .= "and status=1";

		$row_existing_trip_res = mysqli_query($connect,$row_query_existing_trip);
		
		$row_query_request_trip  = "select * from $dbtable ";
		$row_query_request_trip .= "Where trip_username='$request_user' ";
		$row_query_request_trip .= "and status=1";

		$row_request_trip_res = mysqli_query($connect,$row_query_request_trip);
		
		if(mysqli_num_rows($row_existing_trip_res)==0 && mysqli_num_rows($row_request_trip_res)==0){
			if(!empty($request_user) && !empty($request_day) && !empty($request_passenger)){
				$request_user=mysqli_real_escape_string($connect, $request_user);
				$request_day=mysqli_real_escape_string($connect, $request_day);
				$request_passenger=mysqli_real_escape_string($connect, $request_passenger);

				$insert  = "insert into $dbtable ";
				$insert .= "(trip_username, operation_days, total_passengers, status) values ";
				$insert .= "('$request_user', '$request_day', '$request_passenger', 1)";

				$qry_insert = mysqli_query($connect,$insert);

				if($qry_insert && mysqli_affected_rows($connect)==1){
					echo "<span style=\"color:green;\">Requested Successfully. Please Wait for Confirmation<br></span>";
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
			echo "You already have a active trip or Requested";
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
					<form action="request.php" method="post">
					<li>
						<label for="days">Days Required:</label> <input id="days" type="text" name="operation_days" value="" placeholder="How many days you will stay">
					</li>
					<li>
						<label for="passengers">Total Passenger:</label> <input id="passengers" type="text" name="total_passengers" value="" placeholder="How many passenger will travel">
					</li>
					
					<li>
						<input type="submit" name="submit" value="Request">
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
</body>
</html>