<?php
	$prodType = $_POST["prodType"];
	$color = $_POST["color"];
	if (isset($_POST["weight"]))
		$weight = $_POST["weight"];
	else
		$weight = "";
	
	$quantity = $_POST["numPacks"];
	
	//If we have one of the hooks, then use just the first charcter
	if ($prodType=="sb" || $prodType=="ts" || $prodType=="bb")
		$prodType = substr($prodType,0,1);
		
	$color = strtolower(substr($color,0,1));
	$prodID = $prodType.$color.$weight;
	
	if (isset($_SESSION["hCart"][$prodID])) {
		$_SESSION["hCart"][$prodID]+=$quantity;
	} else {
		$_SESSION["hCart"][$prodID]=$quantity;
	}
	$prodName = $prodID;
	$sql = "SELECT product_name FROM products WHERE product_ID='$prodID'";
	$result = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($result)==0) {
		echo "sql='".$sql."'";
	} else {
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$prodName = $row["product_name"];
	}
?>
<p>Product added to cart: <?php
	echo $prodName . " - ". $quantity;
?></p>
<p><a href="index.php?content=prod"><img src="images/contShop2.png" width="113" height="32" border="0" /></a>&nbsp;&nbsp;
<a href="index.php?content=reviewCart"><img src="images/checkout.png" width="113" height="32" border="0" /></a></p>