
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>TravelAgent</title>
  <meta name="description" content="homepage of our company" />
  <meta name="keywords" content="home, travel, agent, trip" />
  <meta name="author" content="Our names" /> 
  
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Lora|Open+Sans" rel="stylesheet" />
  <link href = "style/style.css" rel = "stylesheet"/>
</head>

<body class = "body">
  
  <?php 
  	$servername = "127.0.0.1";
	$username = "root";
	$password = "root";
	$port = 8889;
	
	// Create connection
	$conn = mysql_connect("$servername:$port", $username, $password);
	
	//create database if not exists -- travel_booker
    $sql = "CREATE DATABASE IF NOT EXISTS travel_booker";
	$create_database = mysql_query($sql);
	
	//select a database
	$select = mysql_select_db("travel_booker");
	
	//get 3 random spots from database
	$spots = array();
	$sql = "SELECT id FROM travel_spots";
	$result = mysql_query($sql);
	while(($row = mysql_fetch_row($result)) != FALSE){
		$spots[] = $row[0];
	}
	
	$rand_keys = array_rand($spots, 3);
	$spot1_id = $spots[$rand_keys[0]];
	$spot2_id = $spots[$rand_keys[1]];
	$spot3_id = $spots[$rand_keys[2]];
	
	$sql = "SELECT name, description, image FROM travel_spots WHERE id = '$spot1_id' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$spot1_name = $row[0];
	$spot1_desc = $row[1];
	$spot1_img = "picture/spots/".$row[2];
	
	$sql = "SELECT name, description, image FROM travel_spots WHERE id = '$spot2_id' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$spot2_name = $row[0];
	$spot2_desc = $row[1];
	$spot2_img = "picture/spots/".$row[2];
	
	$sql = "SELECT name, description, image FROM travel_spots WHERE id = '$spot3_id' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$spot3_name = $row[0];
	$spot3_desc = $row[1];
	$spot3_img = "picture/spots/".$row[2];
	
	
  ?>

  <!-- A flowbox is used for layout the header-->
  <div class = "flexbox_head_container">
	  
	  <!--insert logo image-->
	  <div class = "flexbox_head_item1">
		  <a href = "homepage.php">
		  <img src = "picture/logo.png" alt = "logo"/>
		  </a>
	  </div>
	  
	  <!--create the navigation list-->
	  <div class = "flexbox_head_item2">
			  <ul>
				  <li> <a href = "homepage.php">HOME</a> </li>
				  <li> <a href = "about.htm">ABOUT</a> </li>
				  <li> <a href = "contact.htm">CONTACT</a> </li>
				  <li> <a href = "service.htm">SERVICE</a> </li>
				  <li> <a href = "booking.php">BOOKING</a> </li>
			  </ul>
	  </div>
  
  </div>
 
  
  
  <div id = "homepage_section1">
	  
	  <img src = "picture/hero_image.jpg" alt = "hero image"/>
	  <div id = "center_text"> COLLECT MOMENTS <br/> NOT THINGS </div>
	  
  </div>  
  
  <div id = "homepage_section3">
	  
	  <h2>THIS MONTHS HOT DEALS</h2>
	  
	  <table>
		  
		  <tr>
			  <th> <a href = "booking.php"><img src = "<?php echo $spot1_img; ?>" alt = "yellow mountains"/></a></th>
			  <th> <a href = "booking.php"><img src = "<?php echo $spot2_img; ?>" alt = "eiffel tower"/></a> </th>
			  <th> <a href = "booking.php"><img src = "<?php echo $spot3_img; ?>" alt = "amsterdam"/></a> </th>
		  </tr>
		  
		  <tr>
			  <th> <h2> <?php echo $spot1_name; ?> </h2> </th>
			  <th> <h2> <?php echo $spot2_name; ?>  </h2> </th>
			  <th> <h2> <?php echo $spot3_name; ?> </h2> </th>
		  </tr>
		  
		  <tr>
			  <th> <p>  <?php echo $spot1_desc; ?>  </p> </th>
			  
			  <th> <p>  <?php echo $spot2_desc; ?>  </p> </th>
			    
			  <th> <p>  <?php echo $spot3_desc; ?> </p> </th>
		  </tr>
		  
	  </table>
	  
  </div>
  
  <!--to insert a video-->
  <div id = "homepage_section2"> 
	 <object id = "the_video" width="420" height="315" data="https://www.youtube.com/embed/B2ZnGVgKcLc">video</object>
  </div>
  
  
	<div class = "footer">
	<div class = "flexbox_foot_container">
		
		<div class = "flexbox_foot_item1">
			<table frame = "rhs">
				<tr> <th> <a href = "booking.php">Booking</a> </th> </tr>
				<tr> <th> <a href = "service.htm">Service</a></a> </th> </tr>
				<tr> <th> <a href = "contact.htm">Contact Us</a> </th> </tr>
				<tr> <th> <a href = "about.htm">About Us</a> </th> </tr>
				<tr> <th> <a href = "homepage.php">Home</a> </th> </tr>
			</table>
		</div>
		
		<div class = "flexbox_foot_item2">
			<table>
				<tr>
					<th>Travel Booker &copy 2016</th>
					<th>Terms and conditions</th>
				</tr>
			</table>
		</div>
	</div>

	</div>
  
</body>


</html>
