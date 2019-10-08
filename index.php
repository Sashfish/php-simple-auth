<!DOCTYPE html>
<!--establish db connection and load functions-->
<?php
include 'functions.php';
#require 'fb-callback.php';
connectToDB();
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
	<title>RelocateGURU-Home</title>
	<style>
	#capslockwarning {display: none;}
	#pwlengtherror {display: none;}
	#pwspeccharserror {display: none;}
	#pwnumberserror {display: none;}
	#pwuppercaseerror {display: none;}
	#passreminder {display: none;}
	#emailformaterror {display: none;}
	</style>
</head>
<body>
<!--FB initialisation: waiting on Nicole to provide appID and appSecret
php
#session_start();
#$fb = new Facebook\Facebook([
#  'app_id' => '{app-id}', // Replace {app-id} with your app id
#  'app_secret' => '{app-secret}',
#  'default_graph_version' => 'v3.2',
#  ]);
#
#$helper = $fb->getRedirectLoginHelper();
#
#$permissions = ['email']; // Optional permissions
#$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);
#
#echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?-->
<!--login-->
<h2>Login</h2>
<form action = "index.php" method = "post" role="form">
	Email: 		<input type="text" name="email" id="email" required><br>
	Password: <input type="password" name="password" id="password" required><br>
						<input type="checkbox" onclick="revealPassword()" unchecked>Show password<br>
						<p id="capslockwarning">CapsLock is On!</p>
								<input type="submit" value="Login">
</form>
<br>
<?php
	if (isset($_POST['email']) && isset($_POST['password'])) {
	$email=$_POST['email']; //THIS MAY NOT BE INJECTION-SAFE!!!
	$emailq="SELECT email FROM users WHERE email='$email'";
	$em=mysqli_query($conn, $emailq);
	$emailf=mysqli_fetch_row($em);

	$pass=$_POST['password'];//THIS MAY NOT BE INJECTION-SAFE!!!
	$pwq="SELECT password FROM users WHERE password='$pass'";
	$pw=mysqli_query($conn, $pwq);
	$pwf=mysqli_fetch_row($pw);

	$nameq="SELECT name FROM users WHERE email='$email'";
	$name=mysqli_query($conn,$nameq);
	$namef=mysqli_fetch_row($name);
}

if ((isset($_POST['email'])) && (isset($_POST['password']))){
			if (($_POST['email']==$emailf[0]) && ($_POST['password']==$pwf[0])){
			echo 'Logged in as '.$namef[0].'<br>';}
			   else {echo 'Wrong credentials';}}
?>
<br>
<h3><i>Not registered?</i>Click Here</h3>
<hr>
	<h2>REGISTRATION</h2>
<form action="register.php" method ="post" role="form" onsubmit="return checkPasswordInputAndEmailFormat()">
	Name: 	<input type="text" name="name" id="name" required><br>
	Email: 	<input type="text" name="email" id="email" required><br>
					<p id="emailformaterror">Invalid email format</p><br>
	Password: <input type="password" name="pass" id="pass" onfocus="passwordConditionReminder()" onfocusout="passwordConditionReminderHide()" required><br>
							<input type="submit" value="Register">
							<div id="passreminder"><p>The password should contain:</p><ul>
								<li>A number</li>
								<li>An uppercase letter</li>
								<li>A special character</li>
								<li>The password should be at least 8 symbols long</li></div>
							<p id="pwlengtherror">Short</p>
							<p id="pwspeccharserror">No spec chars</p>
							<p id="pwnumberserror">No num</p>
							<p id="pwuppercaseerror">No uppercase</p>
</form>
<?php
//email check
#global $emailformatcheck;
#global $emailok;
if (isset($_POST['email'])){
$emailformatcheck=preg_match("/.+@.+\.\w{2,}/", $_POST['email']);
$emailatsymbolcheck=preg_match_all("/@/", $_POST['email']);
if (($emailformatcheck==0) && ($emailatsymbolcheck>=2)) {$emailok=FALSE;}
	else {$emailok=TRUE;}
}

#php password validation and registration
if (isset($_POST['pass']) && isset($_POST['email'])) {
$pwlength=strlen($_POST['pass']);
$pwspecchars=preg_match('/[\'^£$%&*()}{@#~!?><>,|=_+¬-]/',$_POST['pass']); #https://stackoverflow.com/questions/3938021/how-to-check-for-special-characters-php  --added !
$pwnumbers=preg_match('/\d+/',$_POST['pass']);
$pwuppercase=preg_match('/[A-Z]/',$_POST['pass']);
if (($pwlength>7) && ($pwspecchars>0) && ($pwnumbers>0) && ($pwuppercase>0) && ($emailok==TRUE)) {
if (isset($_POST['email']) && isset($_POST['pass'])){
registration($_POST['email'],$_POST['pass'],$_POST['name'],$conn);}}
else {echo 'Something really went wrong :<';}}
?>
<hr>
<h1>DEBUG</h1><br>
<script src="index.js"></script>
</body>
</html>
