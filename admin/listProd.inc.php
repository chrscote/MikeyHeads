<table width="75%" border="1" bordercolor="#000000">
	<tr>
        <td align="center"><b>Product ID</b></td>
        <td align="center"><b>Product<br />Name</b></td>
        <td align="center"><b>Product<br />Abbr.</b></td>
        <td align="center"><b>Price</b></td>
        <td></td>
        <td></td>
    </tr>
<?php
	$sql = "SELECT * FROM products";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$id = $row["product_ID"];
		$name = $row["product_name"];
		$abbr = $row["prod_abbr"];
		$price = $row["price"];
		$price = number_format($price, 2);
?>
	<tr>
    	<td><?php echo $id ?></td>
        <td><?php echo $name ?></td>
        <td><?php echo $abbr ?></td>
        <td>$<?php echo $price ?></td>
        <td><a href="admin.php?content=editProd&id=<?php echo $id?>">Edit</a></td>
        <td><a href="admin.php?content=rmvProd&id=<?php echo $id?>">Remove</a></td>
    </tr>
<?php
	}
?>
</table>