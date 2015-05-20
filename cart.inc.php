<h4>Your shopping cart:</h4>
<?php
if (!isset($_SESSION["hCart"])) {
	$_SESSION["hCart"] = array();
	echo "is empty\n";
} else {
	$numItems = count($_SESSION["hCart"]);
	if ($numItems==0) 
		echo "is empty\n";
	else {
		$total = 0;
?>		
		<table width="100%" cellpadding="1" border="0">
			<tr>
            	<td><b>Product</b></td>
                <td><b>Qty</b></td>
                <td><b>Total</b></td>
			</tr>
<?php
		$shipping = 0;
		$total = 0;
		$subTotal = 0;
		foreach ($_SESSION["hCart"] as $prod=>$quantity) {
			$sql = "SELECT prod_abbr, price FROM products WHERE product_ID='".$prod."'";
			$result = mysql_query($sql) or die (mysql_error());
			if (mysql_num_rows($result)>0) {
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				$abbr = $row["prod_abbr"];
				$price = $row["price"];
			}
			$subTotal = $quantity * $price;
			$total += $subTotal;
			$tax = $total*0.0635;
?>
			<tr>
            	<td><?php echo $abbr ?></td>
                <td align="center" valign="top"><?php echo $quantity?></td>
<?php
			printf("<td valign=\"top\">%.2lf</td>", $subTotal);?>
			</tr>
<?php	} ?>
			<tr>
            	<td colspan="3"><img src="images/trnsp.gif" width="1" height="10" border="0" /></td>
            </tr>
            <tr>
            	<td colspan="2">Sub-Total</td>
                <td><?php printf("%.2lf", $total);?></td>
            </tr>
            <tr>
            	<td colspan="2">Sales Tax</td>
                <td><?php printf("%.2lf", $tax); ?></td>
            </tr>
            <tr>
            	<td colspan="2"><b>Total:</b></td>
                <td><?php printf("<b>$%.2lf</b>\n", $total+$tax);?></td>
            </tr>
            <tr>
            	<td colspan="3"><a href="index.php?content=reviewCart">Check out</a></td>
            </tr>    
		</table>
<?php
	}
}
?>