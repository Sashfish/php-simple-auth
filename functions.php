<?php
function connectToDB () {
  global $conn;
  $conn=new MySQLi("127.0.0.1:33060","homestead","secret","test");
  if ($conn->connect_error) {
  	die("Connection failed: ".$conn->connect_error);}
  echo "Connected successfully<br>";}

function registration($email,$password,$name,$connection) {
global $checkun;
global $rawinputun;
global $rawinputpw;
  if (isset($email) && isset($password) && isset($name)){
  		$rawinputpw=mysqli_real_escape_string($connection,$password);
      $rawinputname=mysqli_real_escape_string($connection,$name);
  		#reconsider trims
  		$rawinputpw=trim($rawinputpw);
  		#see above
  		#$rawinputun=preg_replace('/[^\p{L}\p{N}\s]/u', '', $email); #https://stackoverflow.com/questions/16733674/php-remove-symbols-from-string
  		$checkunquery=mysqli_query($connection,"SELECT * FROM users WHERE email='$email'");
  		$checkun=mysqli_num_rows($checkunquery);
  			if ($checkun !== 0) {
  					echo 'Email address already in use';}
  					else {
  						$new="INSERT INTO users (name, password, email) VALUES ('$rawinputname','$rawinputpw','$email')";
  						if (($email !='') && ($rawinputpw !='') && ($rawinputname !='')) {
  							if (mysqli_query($connection,$new)){
  								echo 'Account Created';}
  								else {echo 'Error:' . mysqli_error($connection);}
  								mysqli_close($connection);}
  								else {echo 'Error: Email or password cannot contain spaces';}
  							}
                return $email;
              }
}
?>
