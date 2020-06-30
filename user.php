<?php
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}
	$dbtable="user";
	$connect=mysql_conn();

	if(isset($_POST["submit"]) && $_POST["submit"]=="Add"){
		$new_user=$_POST["new_user"];
		$new_pass=pass_encrypt($_POST["new_pass"]);
		$new_fname=$_POST["new_fname"];
		$new_lanme=$_POST["new_lanme"];
		$new_vessel=$_POST["new_vessel"];
		$new_weight=$_POST["new_weight"];
		$new_capacity=$_POST["new_capacity"];
		
		if(!empty($new_user) && !empty($new_fname) && !empty($new_lanme) && !empty($new_vessel) && !empty($new_weight) && !empty($new_capacity)){
			$new_user=mysqli_real_escape_string($connect, $new_user);
			$new_fname=mysqli_real_escape_string($connect, $new_fname);
			$new_lanme=mysqli_real_escape_string($connect, $new_lanme);
			$new_vessel=mysqli_real_escape_string($connect, $new_vessel);
			$new_weight=mysqli_real_escape_string($connect, $new_weight);
			$new_capacity=mysqli_real_escape_string($connect, $new_capacity);
			
			$insert  = "insert into $dbtable ";
			$insert .= "(username, password, first_name, last_name, vessel_type, allow_weight, passenger_capacity) values ";
			$insert .= "('$new_user', '$new_pass', '$new_fname', '$new_lanme', '$new_vessel', '$new_weight', '$new_capacity')";
		
			$qry_insert = mysqli_query($connect,$insert);
			
			if($qry_insert && mysqli_affected_rows($connect)==1){
				echo "<span style=\"color:green;\">User added Successfully. Please check your user below<br></span>";
			}
			else{
				echo $insert."<br>";
				
			}
		}
		else{
			echo "<span style=\"color:red;\">Field can't be empty expect Reference. Please enter again<br></span>";
		}
	}
	if(isset($_POST["submit"]) && $_POST["submit"]=="Delete"){
		$delete_id=$_POST["id"];

		
		if(!empty($delete_id)){
			$end_id=mysqli_real_escape_string($connect, $delete_id);
						
			$delete  = "DELETE FROM `$dbtable` WHERE `$dbtable`.`id` = $end_id";
			
			$qry_delete = mysqli_query($connect,$delete);
			
			if($qry_delete && mysqli_affected_rows($connect)==1){
				echo "<span style=\"color:green;\">User Deleted Successfully. Please check your availbale User below<br></span>";
			}
			else{
				echo $delete."<br>";
				
			}
			
		
		}
		else{
			echo "<span style=\"color:red;\">Field can't be empty. Please enter again<br></span>";
		}
	}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fisharies Users</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/user.css">
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
					<li><a href="details.php">Details</a></li>
					<li class="page_active"><a href="user.php">User</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!--Heading End-->
	<body>
		<!--User Add Start-->
		<section class="users_add">
			<div class="container">
				<label for="adduser">Adding New User</label>
				<form action="user.php" method="post">
					<table class="user_add_table" id="adduser">
						<tr class="user_add_tableRow">
							<td class="a_cell"><input type="text" name="new_user" placeholder="Enter User"></td>
							<td class="a_cell"><input type="text" name="new_pass" placeholder="Enter Password"></td>
							<td class="a_cell"><input type="text" name="new_fname" placeholder="Enter First Name"></td>
							<td class="a_cell"><input type="text" name="new_lanme" placeholder="Enter Last Name"></td>
							<td class="a_cell"><input type="text" name="new_vessel" placeholder="Enter vessel Type"></td>
							<td class="a_cell"><input type="text" name="new_weight" placeholder="Enter Weight"></td>
							<td class="a_cell"><input type="text" name="new_capacity" placeholder="Enter Passenger Capacity"></td>
							<td class="a_cell"><input type="submit" name="submit" value="Add"></td>
						</tr>
					</table>
				</form>
				
			</div>
		</section>
		<!--User Add End-->
		
		<!--User View Start-->
		<section class="users_view">
			<div class="container">
				<label for="myTable">Existing User</label>
				<table class="table" id="myTable">
					<tr class="tableHeadRow">
						<th class="cell">User ID</th>
						<th class="cell">Added On</th>
						<th class="cell">First Name</th>
						<th class="cell">Last Name</th>
						<th class="cell">Username</th>
						<th class="cell">Vessel Type</th>
						<th class="cell">Allow<br>Weight (kg)</th>
						<th class="cell">Passenger<br>Capacity</th>
						<th class="cell">Last Trip</th>
						<th class="cell">Action</th>
					</tr>
					<?php 
						$row_query  = "select * from $dbtable ";
						$row_query .= "order by id DESC";

						$row_res = mysqli_query($connect,$row_query);

						while($row=mysqli_fetch_assoc($row_res)){

							echo "<tr class=\"tableRow\">";
								echo "<td class=\"cell\">";
									echo $row["id"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["added_date"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["first_name"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["last_name"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["username"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["vessel_type"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["allow_weight"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["passenger_capacity"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo $row["last_trip"];
								echo "</td>";
								echo "<td class=\"cell\">";
									echo "<form action=\"user.php\" method=\"post\">";
											echo "<input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">";
											echo "<input type=\"submit\" name=\"submit\" value=\"Delete\">";
										echo "</form>";
								echo "</td>";
							echo "</tr>";
						}
						mysqli_free_result($row_res);
					?>
				</table>
				
			</div>
		</section>
		<!--User View End-->
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