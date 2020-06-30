<?php
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}
	$dbtable="trip";
	$dbtable2="trip_request";
	$connect=mysql_conn();
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
						<li class="active_details"><a href="history.php">History</a></li>
					</ul>
				</aside>
				
				<section class="details_body">
					<label for="myTable">Previous Trip</label>
					<table class="table" id="myTable">
						<tr class="tableHeadRow">
							<th class="cell">Trip ID</th>
							<th class="cell">User</th>
							<th class="cell">Latitude</th>
							<th class="cell">Longitude</th>
							<th class="cell">Last Seen</th>
							<th class="cell">Start Day</th>
							<th class="cell">Current<br>Weight</th>
							<th class="cell">Current<br>Passengers</th>
						</tr>
						<?php 
							$row_query  = "select * from $dbtable ";
							$row_query .= "Where status=2 order by id DESC";

							$row_res = mysqli_query($connect,$row_query);

							while($row=mysqli_fetch_assoc($row_res)){

								echo "<tr class=\"tableRow\">";
									echo "<td class=\"cell\">";
										echo $row["id"];
									echo "</td>";
									echo "<td class=\"cell\">";
										echo $row["trip_username"];
									echo "</td>";
									echo "<td class=\"cell\">";
										echo $row["latitude"];
									echo "</td>";
									echo "<td class=\"cell\">";
										echo $row["longitude"];
									echo "</td>";
									echo "<td class=\"cell\">";
										echo $row["last_seen"];
									echo "</td>";
									echo "<td class=\"cell\">";
										echo $row["trip_started"];
									echo "</td>";
									echo "<td class=\"cell\">";
										echo $row["current_weight"];
									echo "</td>";
									echo "<td class=\"cell\">";
										echo $row["total_passengers"];
									echo "</td>";
								echo "</tr>";
							}
							mysqli_free_result($row_res);
						?>
					</table>
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