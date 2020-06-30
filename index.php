<?php
	ini_set('session.gc_maxlifetime', 0);
	require("function/session.php");
	require("function/function.php");
	if(!isset($_SESSION["username"])){redirect_to("login.php");}
	$dbtable="trip";
	$dbtable2="trip";
	$connect=mysql_conn();
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
			<div class="menu">
				<ul>
					<li class="page_active"><a href="index.php">Live View</a></li>
					<li><a href="details.php">Details</a></li>
					<li><a href="user.php">User</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!--Heading End-->
	<main>
		<section class="map">
			<div class="container">
				<div id="map" style="width: 100%; height: 400px;"></div>
			</div>
			
		</section>
		
		
	</main>
	
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
	<script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
    <script type="text/javascript">
    var locations = [
		<?php 
			$row_query  = "select * from $dbtable ";
			$row_query .= "Where status=1 order by id DESC";

			$row_res = mysqli_query($connect,$row_query);
			$i=1;
			$lat=0;
			$lon=0;
			while($row=mysqli_fetch_assoc($row_res)){

				echo "['".$row["trip_username"]."', ".$row["latitude"].", ".$row["longitude"].", ".$i."],";
				$lat = $lat + $row["latitude"];
				$lon = $lon + $row["longitude"];
				$i++;
			}
			$lat_avg = $lat/($i-1);
			$lon_avg = $lon/($i-1);
			mysqli_free_result($row_res);
		?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(<?php echo $lat_avg.",".$lon_avg;?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
	
</body>
</html>