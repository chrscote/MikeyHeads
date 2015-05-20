<?php
	$id = $_GET["id"];
	$sql = "SELECT * FROM products WHERE product_ID='$id'";
	$result = mysql_query($sql);
	if ($result) {
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
?>

<form name="editProd" action="admin.php" method="post" onsubmit="return chkValsEditProd();">
<table>
	<tr>
    	<td align="center"><b>Product ID</b></td>
    	<td align="center"><b>Product<br />Name</b></td>
    	<td align="center"><b>Product<br />Abbr.</b></td>
    	<td align="center"><b>Price</b></td>
    </tr>
    <tr>
    	<td><?php echo $id ?><input type="hidden" name="prodID" value="<?php echo $id ?>" /></td>
    	<td><input type="text" name="prodName" value="<?php echo $row["product_name"] ?>" /></td>
    	<td><input type="text" name="prodAbbr" value="<?php echo $row["prod_abbr"] ?>" /></td>
    	<td><input type="text" name="prodPrice" value="<?php echo $row["price"] ?>" /></td>
        <input type="hidden" name="content" value="changeProd" />
        <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
    </tr>
    <tr>
    	<td colspan="2" align="center"><input type="submit" value="Make Changes" /></td>
        <td colspan="2" align="center"><input type="button" value="Cancel Changes" onclick="javascript:backToList();" />
    </tr>
</table>
</form>
<?php
	} else {
?>
<p>Error displaying product.  Please return to the Product List and reselect.</p>
<?php
	}
?>