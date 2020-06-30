<?php
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}
	$dbtable="trip_request";
	$dbtable2="trip";
	$connect=mysql_conn();

	if(isset($_POST["submit"]) && $_POST["submit"]=="Approve"){
		$approve_user=$_POST["trip_username"];
		$approve_days=$_POST["operation_days"];
		$approve_passengers=$_POST["total_passengers"];

		
		if(!empty($approve_user) && !empty($approve_days) && !empty($approve_passengers)){
			$approve_user=mysqli_real_escape_string($connect, $approve_user);
			$approve_days=mysqli_real_escape_string($connect, $approve_days);
			$approve_passengers=mysqli_real_escape_string($connect, $approve_passengers);
			
			$insert  = "insert into $dbtable2 ";
			$insert .= "(trip_username, operation_days, total_passengers, status) values ";
			$insert .= "('$approve_user', '$approve_days', '$approve_passengers', 1)";
		
			$qry_insert = mysqli_query($connect,$insert);
			
			$update  = "UPDATE `$dbtable` SET `status` = '2' WHERE `$dbtable`.`trip_username` = '$approve_user'";
			
			$qry_update = mysqli_query($connect,$update);
			
			if($qry_insert && mysqli_affected_rows($connect)==1){
				echo "<span style=\"color:green;\">Trip Approve Successfully. Please check Active Page<br></span>";
			}
			else{
				echo $insert."<br>";
				
			}
			
		
		}
		else{
			echo "<span style=\"color:red;\">Field can't be empty expect Reference. Please enter again<br></span>";
		}
	}
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
						<li class="active_details"><a href="approve.php">Approve</a></li>
						<li><a href="active.php">Active</a></li>
						<li><a href="history.php">History</a></li>
					</ul>
				</aside>
				
				<section class="details_body">
					<!--User View Start-->
					<section class="request_view">
						<div class="container">
							<label for="myTable">Available Approval Request</label>
							<table class="table" id="myTable">
								<tr class="tableHeadRow">
									<th class="cell">Serial no</th>
									<th class="cell">Resquested User</th>
									<th class="cell">Expected Trip Duration</th>
									<th class="cell">Total Passengers</th>
									<th class="cell">Action</th>
								</tr>
								<?php 
									$row_query  = "select * from $dbtable ";
									$row_query .= "WHERE status=1 order by id DESC";

									$row_res = mysqli_query($connect,$row_query);
									$i=1;
									while($row=mysqli_fetch_assoc($row_res)){
										
										echo "<form action=\"approve.php\" method=\"post\">";
											echo "<tr class=\"user_add_tableRow\">";
												echo "<td class=\"a_cell\"><input type=\"text\" name=\"sl\" value=\"".$i."\" readonly></td>";
												echo "<td class=\"a_cell\"><input type=\"text\" name=\"trip_username\" value=\"".$row["trip_username"]."\" readonly></td>";
												echo "<td class=\"a_cell\"><input type=\"text\" name=\"operation_days\" value=\"".$row["operation_days"]."\" readonly></td>";
												echo "<td class=\"a_cell\"><input type=\"text\" name=\"total_passengers\" value=\"".$row["total_passengers"]."\" readonly></td>";
												echo "<td class=\"a_cell\"><input type=\"submit\" name=\"submit\" value=\"Approve\"></td>";
											echo "</tr>";
										echo "</form>";
										$i++;
									}
									mysqli_free_result($row_res);
								?>
							</table>

						</div>
					</section>
					<!--User View End-->
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