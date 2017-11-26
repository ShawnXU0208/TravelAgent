
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<?php 

	  $servername = "127.0.0.1";
	  $username = "root";
	  $password = "root";
	  $port = 8889;
	  // Create connection
	  $conn = mysql_connect("$servername:$port", $username, $password);

	  // Check connection
	  if (!$conn) {
		  die("Connection failed: " . mysql_connect_error());
	  }
	  $select = mysql_select_db("travel_booker");
	  
	  if (count($_GET) > 0){
		  $location = $_GET['location'];
	  }
	  $sqlString = "SELECT * FROM travel_spots WHERE location = '$location'";
	  $result = mysql_query($sqlString);

	  while(($row = mysql_fetch_row($result)) != FALSE){
		  $spot_id = $row[0];
		  $spot_name = $row[1];
		  $spot_location = $row[2];
		  $spot_description = $row[3];
		  $spot_childPrice = $row[4];
		  $spot_adultPrice = $row[5];
		  $spot_image = "picture/spots/".$row[6];
		  
		  #$spot_description = str_pad($spot_description, 200, "a");
	?>
		  <a class = "one_spot" onclick = "show_trip_info('<?php echo $spot_name; ?>', '<?php echo $spot_childPrice; ?>', '<?php echo $spot_adultPrice; ?>', '<?php echo $spot_id; ?>')" href = "#choose_date">
			  <h2> <?php echo $spot_name; ?></h2>
			  <img src = <?php echo $spot_image; ?> alt = <?php echo $spot_name; ?> width = "300" height = "200" />
			  
			  <div class = "desc">
				  <p><?php echo $spot_description; ?></p>
			  </div>
			  
			  <div class = "info">
				  Cost per person per night: <br />
				  Adult: $<?php echo $spot_adultPrice; ?> <br />
				  Child: $<?php echo $spot_childPrice; ?>
			  </div>
		  </a>
	<?php } ?>

</html>

