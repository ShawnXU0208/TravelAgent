<link href = "style/style.css" rel = "stylesheet"/>

<script type = "text/javascript">
  function cancel_login(){
	  document.getElementById('login').style.display = 'none';
  }
</script>

<script type="text/javascript">
  function login_check() {
	  
	  "<?php 
	      	$servername = "127.0.0.1";
			$username = "root";
			$password = NULL;
			
			$conn = mysql_connect($servername, $username, $password);
			$select = mysql_select_db("travel_booker");
			
			$sql = "SELECT email FROM customers";
			$result = mysql_query($sql);
			
			$email_array = array();
			while(($row = mysql_fetch_row($result)) != FALSE){
				$one_email = $row[0];
				$email_array[] = $one_email;
		    }
		    
	  ?>"
	  
	  var email = document.getElementById("login_email").value;
	  
	  var j_emails= <?php echo json_encode($email_array); ?>;
	  
      if (j_emails.indexOf(email) != -1){
		 
		  document.getElementById("checkout_form").style.display = "block"; 
		  return true;
	  }else{
		  alert("wrong email address!!");
	  }
	  return false;
  }  
</script> 

<script type="text/javascript">
  function register_check() {
	  
	  "<?php 
	      	$servername = "127.0.0.1";
			$username = "root";
			$password = NULL;
			
			$conn = mysql_connect($servername, $username, $password);
			$select = mysql_select_db("travel_booker");
			
			$sql = "SELECT email FROM customers";
			$result = mysql_query($sql);
			
			$email_array = array();
			while(($row = mysql_fetch_row($result)) != FALSE){
				$one_email = $row[0];
				$email_array[] = $one_email;
		    }
		    
	  ?>"
	  
	  var email = document.getElementById("register_email").value;
	  
	  var j_emails= <?php echo json_encode($email_array); ?>;
	  
	  //check whether the email has been used or is in a validated format
      if (j_emails.indexOf(email) == -1){
	      var email_regular_expression  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	      if (!email_regular_expression.test(email)){
		      alert("please enter a right email address");
		      return false;
	      }else{
			  document.getElementById("checkout_form").style.display = "block"; 
			  alert("You just registered successfully");
			  return true;
	      }
	  }else{
		  alert("The email address has been used");
	  }
	  return false;
  }  
</script> 

<?php
	//echo "<input type = 'text' value = <?php echo $spot_nam
	$spot_name = $_GET['spot_name'];
	$spot_childprice = $_GET['spot_childprice'];
	$spot_adultprice = $_GET['spot_adultprice'];
	$spot_id = $_GET['spot_id'];

	echo "<div id = 'login_register_forms'>";
		echo "<form id = 'login_form' method = 'get' onsubmit = 'return login_check()' action = 'booking.php#checkout_form'>";
			echo "<h1>login</h1>";
			echo "<p>if you own a registered email</p>";
			
			echo "<input type = 'hidden' name = 'trip_name' value = '$spot_name' />";
			echo "<input type = 'hidden' name = 'child_price' value = '$spot_childprice' />";
			echo "<input type = 'hidden' name = 'adult_price' value = '$spot_adultprice' />";
			echo "<input type = 'hidden' name = 'spot_id' value = '$spot_id' />";
			
			echo "<input type = 'email' id = 'login_email' name = 'login_email' size = '30' placeholder = 'enter your email'>";
			echo "</br>";
			echo "<input type = 'submit' name = 'login_submit' value = 'let me in' />";
		echo "</form>";
		
		echo "<form id = 'register_form' method = 'get' onsubmit = 'return register_check()' action = 'booking.php#checkout_form'>";
			echo "<h1>register</h1>";
			echo "<p>if this is your first time to use our website</p>";
			
			echo "<input type = 'hidden' name = 'trip_name' value = '$spot_name' />";
			echo "<input type = 'hidden' name = 'child_price' value = '$spot_childprice' />";
			echo "<input type = 'hidden' name = 'adult_price' value = '$spot_adultprice' />";
			echo "<input type = 'hidden' name = 'spot_id' value = '$spot_id' />";
			
			echo "<input type = 'text' id = 'register_name' name = 'register_name' size = '30' placeholder = 'your name'>";
			echo "</br>";
			echo "<input type = 'text' id = 'register_phone' name = 'register_phone' size = '30' placeholder = 'your phone'>";
			echo "</br>";
			echo "<input type = 'email' id = 'register_email' name = 'register_email' size = '30' placeholder = 'your email'>";
			echo "</br>";
			echo "<input type = 'submit' name = 'register_submit' value = 'let me in' />";
			
		echo "</form>";
		
		echo "<button id = 'cancel_button' onclick = 'cancel_login()'>cancel</button>";

	echo "</div>";	
?>

