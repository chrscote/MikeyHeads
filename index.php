<?php
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	session_start();
	include("connect_to_mysql.php");
	login();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Shaky Head, Bass Fishing, fishing, baits, mikeyhead, hooks, underspin" />
        <title>Mikey Heads Baits</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css" />
        <script src="hookIds.js"></script>
<?php
		if (isset($_REQUEST["content"])) {
			if ($_REQUEST["content"]=="prod" ||$_REQUEST["content"]=="reviewCart") {
?>
		<script language="javascript">
			function changeImg() {
				var val=-1;
				var frm = document.hooks;
				var clickedElmt = event.srcElement;
				color = document.getElementsByName("color");
				if (clickedElmt.name=="color") {
					for (var n=0; n<color.length; n++) {
						if (color[n].checked) {
							val =  color[n].value;
							//break;
						}
					}
					var hook = document.hookPic.src.substr(0, document.hookPic.src.lastIndexOf(".")-3);
					//alert("hook="+hook);
					document.hookPic.src=hook+val+".jpg";
				}
			}
			function changeID() {
				changeImg();
				var type;
				var color;
				var size;
				type = document.getElementById("hookType").value;
				clr = document.getElementsByName("color");
				for (var n=0; n<clr.length; n++) {
					if (clr[n].checked) {
						color =  clr[n].value;
						//break;
					}
				}
				wts = document.getElementsByName("weight");
				for (var i=0; i<wts.length; i++) {
					if (wts[i].checked) {
						size = wts[i].value;
					}
				}
				type = type.substr(0,1);
				color = color.substr(0,1).toLowerCase();
				
				//alert("id="+ hookID[type+color+size]);
				hostID = document.getElementById("hosted_button_id");
				hostID.value = hookID[type+color+size];
				//alert(hostID.value);
			}
			function checkInput() {
				var good = true;
				var frm = document.hooks;
				var numHooks = frm.numPacks.value;
				if (numHooks == "") {
					alert("Please enter the number of packs you would like.");
					good = false;
					
					frm.numPacks.focus();
				}
				return good;
			}
			function goBack() {
				//alert("go back");
				window.location.href="index.php?content=prod";
			}
		</script>
<?php
			} else if ($_REQUEST["content"]=="photo") {
?>
		<link rel="stylesheet" type="text/css" href="photo.css" />
		<script language="javascript">
			function changeImg() {
				var clicked = event.srcElement.src;
				var img = clicked.substr(0,clicked.lastIndexOf(".")-6);	//Take off _Thumb
				img = "images/"+img.substr(img.lastIndexOf("/")+1)+".jpg";
				var mainImg = document.getElementById("mainImg");
				//alert(img);
				mainImg.src = img;
			}
			function changePage(pageNum) {
				for (var n=1; n<=4; n++) {
					document.getElementById("page"+n).style.display="none";
				}
				document.getElementById("page"+pageNum).style.display="inline";
			}
		</script>
<?php				
			}
		}
?>
    </head>
    <body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
    	<table border="1" cellspacing="0" cellpadding="0" width="100%" height="100%">
        	<tr>
            	<td id="header" colspan="3" align="center"><?php include("header.inc.php"); ?></td>
            </tr>
            <tr>
            	<td width="20%" bgcolor="#2E6C3B" id="nav" height="100%"><?php include("nav.inc.php"); ?></td>
                <td bgcolor="#EFE9B7" id="main" width="60%">
                <?php
					if (!isset($_REQUEST["content"])) {
						include("main.inc.php");
					} else {
						$content = $_REQUEST["content"];
						$page = $content.".inc.php";
						include($page);
					}
				?>
                </td>
                <td width="20%" valign="top" id="cart"><?php include("cart.inc.php"); ?></td>
            </tr>
            <tr>
            	<td colspan="3"><?php include("footer.inc.php"); ?></td>
            </tr>
        </table>
    </body>
</html>
<?php
	//mysql_close();
?>