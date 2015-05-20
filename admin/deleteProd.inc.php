<?php
	//User has already agreed to remove the product.
	$id = $_POST["id"];
	$sql = "DELETE FROM products WHERE product_id='".$id."'";
	$result = mysql_query($sql);
	if ($result) {
		header('Location: admin.php?content=listProd');
	} else {
		echo "Could not delete product.";
	}
?>