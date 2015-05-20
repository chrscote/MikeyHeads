<?php
	$button = $_POST["button"];
	$prodID = $_POST["id"];
	if ($button=="Update") {
		$quantity = $_POST["quantity"];
		$_SESSION["hCart"][$prodID]=$quantity;
		
		header("Location:index.php?content=reviewCart");
	} else {
		//We are actually removing this product from the cart
		$prodID = $_GET["id"];
		unset($_SESSION["hCart"][$prodID]);
		header("Location:index.php?content=reviewCart");
	}
?>