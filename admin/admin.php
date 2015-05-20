<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../mystyle.css" />
<title>Mikey Heads - Admin Control</title>
<script src="func.js"></script>
</head>
<?php
	include("../connect_to_mysql.php");
	login();
?>
<body>
	<table width="100%" border="0" cellspacing="2px">
    	<tr>
        	<td colspan="2" id="header" height="90"><?php include("adminHeader.inc.php");?></td>
        </tr>
        <tr>
        	<td id="nav" width="10%" valign="top"><?php include("adminNav.inc.php");?></td>
            <td id="content" width="90%" valign="top"><?php 
				if (!isset($_REQUEST["content"])){ 
					if (!isset($_SESSION["admin"])) {
						include("adminLogin.html");
					} else {
						include("adminMain.inc.php");
					}
				} else {
					$content = $_REQUEST["content"];
					$nextPage = $content . ".inc.php";
					include($nextPage);
				}
			?></td>
        </tr>
    </table>
<?php
	mysql_close();
?>
</body>
</html>