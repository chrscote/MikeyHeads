<?php
	function login(){
		$con = mysql_connect("localhost", "test", "test") or die ("Could not connect to server");
		//$con = mysql_connect("50.62.209.108", "adminCC", "08Cote29!") or die ("Could not connect to server");
		mysql_select_db("mikeyheads", $con) or die ("Could not connect to database.");
		//echo ("Connected to DB");
	}
	login();
?>