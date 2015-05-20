<?php
	session_start();
	include ("../connect_to_mysql.php");
	login();
	
	$userID = mysql_real_escape_string($_POST["userID"]);
	$password =  mysql_real_escape_string($_POST["password"]);
	
	$query = "SELECT * from admin WHERE userID='".$userID."' and password=PASSWORD('".$password."')";
	//echo $query;
	$result = mysql_query($query);
	if (!$result) {
		die("Invalid query<br />".mysql_error());
	}
	if (mysql_num_rows($result)==0) {
		echo "<h2>Sorry, your account was not validated.</h2><br />\n";
		echo "<a href=\"admin.php\">Try again</a><br />\n";
	} else {
		$_SESSION["admin"]=$userID;
		$_SESSION["password"]=$password;
		header('Location: admin.php');
		//echo "Login correct";
	}
?>