<?php
	$id = $_POST["id"];
	$prodID = $_POST["prodID"];
	$prodName = $_POST["prodName"];
	$prodAbbr = $_POST["prodAbbr"];
	$prodPrice = $_POST["prodPrice"];
	
	$sql = "UPDATE products SET product_ID='$prodID', product_name='$prodName', prod_abbr='$prodAbbr', price='$prodPrice' WHERE id=$id";
	$result = mysql_query($sql);
	if ($result) {
		header('Location: admin.php?content=listProd');
	} else {
?>
<p>Unable to update product table.</p>
<?php
		echo mysql_error();
	}
?>