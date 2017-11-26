
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Booking</title>
  <meta name="description" content="list travel spots for choosing and booking"/>
  <meta name="keywords" content="price, tourists, attractions, check out"/>
  <meta name="author" content="Our names"/> 
  
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Lora|Open+Sans" rel="stylesheet" />
  <link href = "style/style.css" rel = "stylesheet"/>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
  
  <script type="text/javascript">
	  function change_category(location) {
		  var location_name = location.replace(/%20/g, " ");
		  document.getElementById("current_category").innerHTML = location_name;
		  $('#show_content').load('data.php?location=' + location);
	  } 
	  

  </script>
 

  <script type="text/javascript">
	  function show_trip_info(name, childprice, adultprice, id){
		  //show login form
		  var spot_name = name.replace(/ /g,"%20");
		  var spot_childprice = childprice.replace(/ /g,"%20");
		  var spot_adultprice = adultprice.replace(/ /g,"%20");
		  var spot_id = id.replace(/ /g,"%20");

		  document.getElementById("login").style.display = "block";  
		  $('#login').load("login_process.php?spot_name="+spot_name+"&spot_childprice="+spot_childprice+"&spot_adultprice="+spot_adultprice+"&spot_id="+spot_id);
	  }
  </script>  
  
  
  <script type="text/javascript">
      function show_confirm_box(total_price, leave_date, spot_id){
		  
		  var email_address = document.getElementById("customer_email").value;		  
		  var confirm_box = confirm("The total price is " + total_price + " dollars\n do you want to continue?");
		  
		  email_address = email_address.replace(/ /g,"%20");
		  leave_date = leave_date.replace(/ /g,"%20");
		  spot_id = spot_id.replace(/ /g,"%20");
		  
		  if (confirm_box == true){
			  $('#hidden_area').load("populate_order.php?customer_email="+email_address+"&leave_date="+leave_date+"&spot_id="+spot_id);
			  alert("We have received your order and someone will get back to you within the next 20 minutes to confirm and book your trip. Thank you for booking with Travel Booker. We hope your trip is an adventure is worth a thousand memories and experiences");
			  
		  }
		  
		  
	  }
  </script>  
  
  
  <script type="text/javascript">
	  
	  function exit_current_account(){
		  location.href = 'booking.php';
	  }
	  
	  function right_year(year){
		  if (Number(year) === parseInt(year, 10)){
			  return true;
		  }
		  
		  return false;
	  }
	  
	  function right_month(month){
		  if (Number(month) === parseInt(month, 10)){
			  if (month > 0 && month <= 12){
				  return true;
			  }
		  }
		  return false;
	  }
	  
	  function right_date(date, month, year){
		  var solar_month = [1,3,5,7,8,10,12];
		  var lunar_month = [4,6,9,11];
		  
		  if (Number(date) === parseInt(date, 10)){
			  if (month == 2){  // feburary
				  if (year % 4 == 0){ // leap year
					  if (date <= 29){
						  return true;
					  }
				  }else{   //not leap year
					  if (date <= 28){
						  return true;
					  }
				  }
			  }else if (solar_month.indexOf(Number(month)) != -1){  // solor month
				  if (date <= 31){
					  return true;
				  }
			  }else if (lunar_month.indexOf(Number(month)) != -1){  // lunar month
				  if (date <= 30){
					  return true;
				  }
			  }
		  }
		  
		  return false;
	  } 

	  
	  
	  function checkout_form_validate(){
		  //check date input
		  var today = new Date();
		  var dd = today.getDate();
		  var mm = today.getMonth()+1; //January is 0!
		  var yyyy = today.getFullYear();
				 
		  var input_dd = document.getElementById("leave_date").value;
		  var input_mm = document.getElementById("leave_month").value;
		  var input_yyyy = document.getElementById("leave_year").value;
		  
		  if (!(right_year(input_yyyy)) || input_yyyy == ""){
			  alert("please enter a correct year number e.g. 2016");
			  return false;
		  }
		  
		  if (!(right_month(input_mm)) || input_mm == ""){
			  alert("please enter a correct month number e.g. 10");
			  return false;
		  }
		  
		  if (!(right_date(input_dd, input_mm, input_yyyy)) || input_dd == ""){
			  alert("please enter a correct date number e.g. 13");
			  return false;
		  }
		  
		  if(input_yyyy < yyyy){
			  alert("the date can not be before today's date");
			  return false;
		  }
		  
		  if(input_yyyy == yyyy){
			  if(input_mm < mm){
				  alert("the date can not be before today's date");
				  return false;  
			  }else if(input_mm == mm){
				  if(input_dd < dd){
					  alert("the date can not be before today's date");
					  return false;
				  }
			  }
		  }
		
		  //check number
		  var child_num = document.getElementById("child_num").value;
		  var adult_num = document.getElementById("adult_num").value;
		  
		  if (child_num == "" || child_num < 0){
			  alert("please enter a correct number for children");
			  return false;
		  }
		  
		  if (adult_num == "" || adult_num < 0){
			  alert("please enter a correct number for adult");
			  return false;
		  }
		  
		  var total_num = Number(adult_num) + Number(child_num);

		  if (total_num == 0){
			  alert("the total number of persons can not be 0");
			  return false;
		  }	 
		  
		  var child_price = document.getElementById("selected_child_price").innerHTML;
		  var adult_price = document.getElementById("selected_adult_price").innerHTML;
		  var spot_id = document.getElementById("selected_id").innerHTML;

		  var total_price = Number(child_price) * Number(child_num) + Number(adult_price) * Number(adult_num);
		  document.getElementById("total_price").value = total_price;
		  
		  var leave_date = input_dd + " / " + input_mm + " / " + input_yyyy;
		  document.getElementById("leave_date").value = leave_date;
		  
		  document.getElementById("spot_id").value = spot_id;
		  
		  show_confirm_box(total_price, leave_date, spot_id);
		  
	  }
  </script>

</head>


<body class = "body">
  
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
 
  
  <div id = "booking_img_header">
	  <img src = "picture/reflection.jpg" alt = "reflection"/>
	  <div class = "text">BOOK YOUR TRIP</div>
  </div>
  
  <div id = "select_trip_form">
	  <h1> Our Deals </h1>
	  
	  <!--navgation buttons for different categories-->
	  <div id = "deal_categories">
		  <button class = "categories" onclick = "change_category('New%20Zealand')"> New Zealand </button>
		  <button class = "categories" onclick = "change_category('Australia')"> Australia </button>
		  <button class = "categories" onclick = "change_category('The%20Islands')"> The Islands </button>
		  <button class = "categories" onclick = "change_category('Asia')"> Asia </button>
	  </div>
	  
	  <h2 id = "current_category"> New Zealand </h2>
		  
		  
	  <p id = "text_at_top">
		  With many great options of trips, and destinations the right one for you is just a click away. 
		  With a wide range of destinations and lengths you are sure to find the right trip for your needs. 
		  Take a look through the adventures below and enter the number of adults and children and desired 
		  travel dates, then head to the bottom of the page and select your journey from the drop down box. 
		  The total figure will then show and you may proceed to the checkout process. We will then contact 
		  you to confirm and organise every aspect of your trip to your requirements and then you will be 
		  ready to go on your adventure. 
	  </p>	  
	  <div class = "travel_spots">
		  <div id = "show_content">
			  <script>
				  $('#show_content').load('data.php?location=' + "New%20Zealand");
			  </script>
		  </div>
	  </div>
	  
	  <div id = "text_below_products">
		  <p>
			  All prices including flights from a New Zealand location and are in New Zealand Dollars. 
			  Prices are based on the average and may increase or decrease depending on arrangements. 
			  All prices including food and accommodation for the journey of the trip. 
		  </p>
	  </div>
  </div>	
 
  
  <div id = "login"></div>
  
  <form id = "checkout_form" onsubmit = "return checkout_form_validate()" method = "get" action = "booking.php">
	  
	  <!--
	  if either the loging form or the register completed, show a greeting to this customer
	  -->
	  <?php
	      //if an old customer logged in
	      if(isset($_GET["login_submit"])){
			  
			
			  $email_address = $_GET['login_email'];
			  
			  $servername = "127.0.0.1";
			  $username = "root";
			  $password = "root";
			  $port = 8889;
			
			  $conn = mysql_connect("$servername:$port", $username, $password);
			  $select = mysql_select_db("travel_booker");
			
			  $sql = "SELECT * FROM customers WHERE email = '$email_address'";
			  $result = mysql_query($sql);
			
			  while(($row = mysql_fetch_row($result)) != FALSE){
				  $customer_name = $row[0];
				  $customer_phone = $row[1];
				  $customer_email = $row[2];
			  }
			  
			  echo "<div id = 'customer_greet'>";
			      echo "<h1>Dear $customer_name </h1>";
			  echo "</div>";
	      }
	      
	      //if a new customer register
	      if(isset($_GET["register_submit"])){
			  
			
			  $customer_email = $_GET['register_email'];
			  $customer_phone = $_GET['register_phone'];
			  $customer_name = $_GET['register_name'];
			  
			  $servername = "127.0.0.1";
			  $username = "root";
			  $password = NULL;
			
			  $conn = mysql_connect($servername, $username, $password);
			  $select = mysql_select_db("travel_booker");
			
			  //insert the new customer infomation to database
			  $sql = "INSERT INTO customers VALUES ('".$customer_name."', '".$customer_phone."','".$customer_email."')";
			  mysql_query($sql);
			  
			  echo "<div id = 'customer_greet'>";
			      echo "<h1>Dear $customer_name </h1>";
			  echo "</div>";
	      }
	  ?>	  
	 
	  <div class = "selected_trip_info">
		  
		  <?php	
		      //if an old customer logged in
		      if(isset($_GET["login_submit"])){
				  $trip_name = $_GET['trip_name'];
				  $child_price = $_GET['child_price'];
				  $adult_price = $_GET['adult_price'];
				  $spot_id = $_GET['spot_id'];
				  
				  echo "<h1>The trip you select currently: <span id = 'selected_name'>$trip_name</span>(<span id = 'selected_id'>$spot_id</span>) </h1>";
				  echo "<p>";
				      echo "The price for each child pernight: <span id = 'selected_child_price'>$child_price</span>";
				      echo "&nbsp &nbsp &nbsp";
				      echo "The price for each adult pernight: <span id = 'selected_adult_price'>$adult_price</span>";
				  echo "</p>";
			  }
			  
			  //if a new customer registered
		      if(isset($_GET["register_submit"])){
				  $trip_name = $_GET['trip_name'];
				  $child_price = $_GET['child_price'];
				  $adult_price = $_GET['adult_price'];
				  $spot_id = $_GET['spot_id'];
				  
				  echo "<h1>The trip you select currently: <span id = 'selected_name'>$trip_name</span>(<span id = 'selected_id'>$spot_id</span>) </h1>";
				  echo "<p>";
				      echo "The price for each child pernight: <span id = 'selected_child_price'>$child_price</span>";
				      echo "&nbsp &nbsp &nbsp";
				      echo "The price for each adult pernight: <span id = 'selected_adult_price'>$adult_price</span>";
				  echo "</p>";
			  }			  
		  ?>
		  
	  </div>
	  
	 
	  <div id = "enter_inputs">
		  <div id = "leaving">
			  <label class = "labels" for = "leave_year">Enter the date to leave:</label>
			  
			  <label class = "inputs" for="leave_year">year:</label>
			  <input class = "inputs" id = "leave_year" type="text" name = "leave_year" size = "4" maxlength="4" />
			  
			  <label class = "inputs" for="leave_month">month:</label>
			  <input class = "inputs" id = "leave_month" type="text" name = "leave_month" size = "4" maxlength="4" />
			  
			  <label class = "inputs" for="leave_date">date:</label>
			  <input class = "inputs" id = "leave_date" type="text" name = "leave_date" size = "4" maxlength="4" />
			  
		  </div>
		  
		  <div id = "child_number">
			  <label class = "labels" for="child_num">Enter the number of children (under 12):</label>
			  <input class = "inputs" id = "child_num" type="number" name = "child_num" />
		  </div>
		  
		  <div id = "adult_number">
			  <label class = "labels" for="adult_num">Enter the number of adults:</label>
			  <input class = "inputs" id = "adult_num" type="number" name = "adult_num" />
		  </div>
		  
		  <div id = "buttons">
			  <input id = "cancel" type = "reset" value = "Exit" onclick = "exit_current_account()" />
			  <input id = "confirm" type = "submit" value = "Confirm" />
		  </div>
	  </div>
	  
	  <?php if(!isset($_GET["login_submit"]) && !isset($_GET["register_submit"])){ ?>
		  <script>document.getElementById("checkout_form").style.display = "none"; </script>
	  <?php } ?>
	  

	  
		  
  </form>
  
  <div id = "hidden_area"></div>
  
  <input type = "hidden" id = "spot_id" name = "spot_id" />
 
	<form id = "order_form" name = "order_form" action = "populate_order.php" method = "get">
		
		<?php if( isset($_GET["login_submit"]) || isset($_GET["register_submit"]) ){ ?>		
			<input type = "hidden" id = "customr_name" name = "customer_name" value = "<?php echo $customer_name; ?>" />
			<input type = "hidden" id = "customer_phone" name = "customer_phone" value = "<?php echo $customer_phone; ?>" />
			<input type = "hidden" id = "customer_email" name = "customer_email" value = "<?php echo $customer_email; ?>" />
			<input type = "hidden" id = "spot_id" name = "spot_id" />
			<input type = "hidden" id = "total_price" name = "total_price" />
			<input type = "hidden" id = "leave_date" name = "leave_date" />
		<?php } ?>
		
	</form>

	
  
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

