<?php
	echo "<h2>Update item in cart</h2><br />\n";
	$prodID = $_GET["id"];
	$quantity = $_SESSION["hCart"][$prodID];
	//Find out the name and price of the product from the prodID in the database.
	$sql = "SELECT product_name, price FROM products WHERE product_ID='".$prodID."'";
	$result = mysql_query($sql) or die (mysql_error());
	
	if (mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$desc = $row["product_name"];
		$price = $row["price"];
	}
	$total = $quantity*$price;
?>	
<form action="index.php" method="post">
	<input type="hidden" name="content" value="changeitem" />
	<input type="hidden" name="id" value="<?php echo $prodID; ?>" />
	<table cellpadding="5" border="0" align="center">
		<tr>
        	<td align="right"><h4>Description:</h4></td>
            <td><?php echo $desc?></td>
        </tr>
		<tr>
        	<td align="right"><h4>Price:</h4></td>
            <td><?php echo $price?></td>
        </tr>
		<tr>
        	<td align="right"><h4>Quantity:</h4></td>
            <td><input type="text" name="quantity" size="3" value="<?php echo $quantity?>" /></td>
        </tr>
		<?php printf("<tr><td><h4>Total</h4></td><td>%.2f</td></tr>\n", $total);?>
        <tr>
        	<td colspan="2"><input type="submit" name="button" value="Update" /><img src="images/trnsp.gif" width="20" height="1" border="0" /><input type="submit" name="button" value="Remove Item from Cart" /></td>
        </tr>
	</table>
	
</form>