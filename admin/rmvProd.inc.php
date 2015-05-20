<?php
	$id = $_GET["id"];
	$sql = "SELECT * FROM products WHERE product_id='".$id."'";
	$result = mysql_query($sql) or die ("Could not select product. ".mysql_error());
	
	if (mysql_num_rows($result)==0) {
		echo "Could not find product with id = ".$id;
	} else {
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$prodID = $row["product_ID"];
		$prodName = $row["product_name"];
		$prodAbbr = $row["prod_abbr"];
		$price = $row["price"];	
?>
<form name="delete" action="admin.php?content=deleteProd" method="post">
<input type="hidden" name="id" value="<?php echo $prodID ?>" />
<table>
	<tr>
    	<td colspan="4"><p>Are you sure you want to delete this product?</p></td>
    </tr>
	<tr>
    	<td><?php echo $prodID?></td>
        <td><?php echo $prodName?></td>
        <td><?php echo $prodAbbr?></td>
        <td><?php echo $price?></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><input type="submit" name="yes" value="YES" /></td>
    	<td colspan="2" align="center"><input type="button" name="cancel" value="NO" onclick="javascript:backToList();" /></td>
    </tr>
</table>
</form>
<?php
	}
?>