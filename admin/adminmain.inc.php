<?php
	$userID = $_SESSION["admin"];
	$password = $_SESSION["password"];
	
	$query = "SELECT * from admin WHERE userID='".$userID."' and password=PASSWORD('".$password."')";
	//echo ($query);
	$result = mysql_query($query);
	$row= mysql_fetch_array($result, MYSQL_ASSOC);
	$name = $row["firstName"]." ". $row["lastName"];
	echo "<h2>Welcome, ".$name."!</h2><br />\n";
	$date = date("l, F j, Y");
	echo "<h2>Today's date: ".$date."</h2><br />\n";
?>