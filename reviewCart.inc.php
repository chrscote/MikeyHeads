<h2>Confirm your shopping cart contents:</h2>
<?php
	if (!isset($_SESSION["hCart"])) {
		$_SESSION["hCart"] = array();
		echo "<p>is empty</p>\n";
	} else {
		$customID = "";
		if (count($_SESSION["hCart"])==0) 
			echo "<p>is empty</p>\n";
		else {
			$total = 0;
			$shipping = 0;
			$itemNum = 0;
			$numItems = 0;
?>
<p>
	<table width="75%" cellpadding="1" border="0">
		<tr>
        	<td></td>
            <td><b>Product</b></td>
            <td align="center"><b>Qty</b></td>
            <td align="right"><b>Total</b></td>
            <td></td>
            <td></td>
		</tr>
<?php
			foreach ($_SESSION["hCart"] as $prod=>$quantity) {
				$customID .= $prod."-".$quantity.",";
				$sql = "SELECT product_name, price FROM products WHERE product_ID='$prod'";
				$result = mysql_query($sql) or die (mysql_error());
				if (mysql_num_rows($result)>0) {
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					$prodName = $row["product_name"];
					$price = $row["price"];
				}
								
				$numItems += $quantity;
?>
		<tr>
        	<td><img src="images/trnsp.gif" width="20" height="1" /></td>
            <td><?php echo $prodName." " ?></td>
            <td align="center"><?php echo $quantity ?></td>
<?php
				$subTotal = $quantity * $price;
				$total = $total + $subTotal;
				printf("<td align=\"right\">%.2lf</td>", $subTotal);
?>
            <td align="center"><a href="index.php?content=modItem&id=<?php echo $prod; ?>">Modify</a></td>
            <td align="center"><a href="index.php?content=changeitem&id=<?php echo $prod;?>">Remove</a></td>
        </tr>
<?php
			}
			if ($numItems==1) {
				$shipping = 1.65;
			} else if ($numItems >= 2 && $numItems <= 3) {
				$shipping = 2.00;
			} else if ($numItems >= 4 && $numItems <= 5) {
				$shipping = 2.50;
			}
			$total += $shipping;
			$tax = $total * 0.0635;
?>
        <tr>
            <td></td>
            <td colspan="4"><img src="images/trnsp.gif" width="1" height="10" border="0" /></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" align="right">Shipping: </td>
            <td align="right"><?php if ($shipping>0) 
					printf("%.2lf", $shipping);
					else
						echo "<b>Free</b>"; ?></td>
        </tr>
        <tr>
        	<td colspan="5"><img src="images/trnsp.gif" width="1" height="15" border="0" /></td>
        </tr>
        <tr>
        	<td></td>
            <td colspan="2" align="right">Sub-Total: </td>
            <td align="right"><?php printf("%.2lf", $total); ?></td>
        </tr>
        <tr>
        	<td></td>
            <td colspan="2" align="right">Sales Tax: </td>
            <td align="right"><?php printf("%.2lf", $tax);?></td>
        </tr>
		<tr>
        	<td></td>
            <td colspan="2" align="right"><b>Total:&nbsp;&nbsp;&nbsp;</b></td>
            <td align="right"><b><?php printf(" $%.2lf", $total+$tax) ?></b></td>
        </tr>
        <form action="https://www.paypal.com/cgi-bin/webscr" target="_self"  method="post">
        	
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1">
            <input type="hidden" name="business" value="mikeben07@yahoo.com">
<?php
	foreach ($_SESSION["hCart"] as $prod=>$quantity) {
		$thisProd = substr($prod, 0, 2);
		$prodPrice = 4.25;
		if ($thisProd=="ts" || $thisProd=="sb" || $thisProd=="bb") {
			//This product is one of the hooks.
			$prodType = substr($prod,0,1);
			if ($prodType=="t")
				$prodType = "Tornado Spin";
			else if ($prodType=="s")
				$prodType = "Swim Bait";
			else
				$prodType = "Bank Beater";
				
			$prodColor = substr($prod, 1, 1);
			switch ($prodColor) {
				case "b":
					$prodColor = "Black";
					break;
				case "w":
					$prodColor = "White";
					break;
				case "r":
					$prodColor = "Watermelon Red";
					break;
				case "g":
					$prodColor = "Green Pumpkin";
					break;
			}
			$prodSize = substr($prod, 2);
			$prodSize = str_replace("_", "/", $prodSize);
			$prodAmt = $prodPrice * $quantity;
		} else {
			//This is one of the lures or other items
			$prodPrice = 4.50;
			if (substr($prod, 0, 2)=="ss")
				$prodType = "Skip Stick";
			$prodSize = "";
			$prodColor=substr($prod,2, 1);
			switch ($prodColor) {
				case "b":
					$prodColor = "Black";
					break;
				case "g":
					$prodColor = "Green Pumpkin";
					break;
				case "r":
					$prodColor = "Watermelon Red";
					break;
			}
			$prodAmt = $prodPrice * $quantity;
		}
		$itemNum++;
?>            
		<input type="hidden" name="quantity_<?php echo $itemNum;?>" value="<?php echo $quantity?>">
		<input type="hidden" name="item_name_<?php echo $itemNum;?>" value="<?php echo $prodSize." ".$prodColor." ".$prodType;?>">
		<input type="hidden" name="item_number_<?php echo $itemNum;?>" value="<?php echo $prod; ?>">
		<input type="hidden" name="amount_<?php echo $itemNum?>" value="<?php echo $prodAmt; ?>">
<?php
	}
		echo "<input type=\"hidden\" name=\"handling_cart\" value=\"$shipping\">\n";
?>			
            <input type="hidden" name="tax_cart" value="<?php printf("%.2lf", $tax);?>" />
        	<input type="hidden" name="totalSale" value="<?php printf(" $%.2lf", $total+$tax);?>" />
		<tr>
        	<td></td>
            <td align="right"><a href="javascript:goBack();"><img src="images/contShop2.png" border="0" width="113" height="32" /></a></td>
            <td></td>
            <!--<td colspan="2"><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;"></td>-->
            <td colspan="2"><input type="image" src="images/btn_xpressCheckout.gif" align="left" style="margin-right:7px;"></td>
        </tr>
        <input type="hidden" name="custom" value="<?php echo $customID; ?>" />
        <input type="hidden" name="cancel_return" value="http://www.MikeyHeadsBaits.com/index.php?content=cancel" />
        <input type="hidden" name="return" value="http://www.MikeyHeadsBaits.com/index.php?content=confirm" />
        <input type="hidden" name="currency_code" value="USD" />
        <input type="hidden" name="lc" value="US" />
        <input type="hidden" name="cbt" value="Return to Mikey Heads Baits" />
        <input type="hidden" name="rm" value="2" />
        <?php
			if ($numItems<6) {
				$numLeft = 6 - $numItems;
				if ($numLeft==1)
					$item = "pack";
				else
					$item = "packs";
		?>
        <tr>
        	<td></td>
        	<td colspan="4"><h4><?php echo "Only ".$numLeft." more ".$item." to get free shipping!" ?></h4></td>
        </tr>
        <?php
			}
		?>
        </form>
	</table>
</p>
<?php
		}
	}
?>
</form>