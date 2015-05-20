<?php
	$sqlCats = "SELECT id, product_type FROM productTypes";
	$resultCat = mysql_query($sqlCats) or die ("Could not query categories. ".mysql_error());
	if (isset($_POST["prodID"])) {
		$cat = $_POST["category"];
		$id = $_POST["prodID"];
		$name = $_POST["prodName"];
		$abbr = $_POST["prodAbbr"];
		$price = $_POST["price"];
		$price = number_format($price, 2);
		
		$sql = "SELECT * FROM products WHERE product_ID='".$id."'";
		$result = mysql_query($sql) or die ("Could not query database. ".mysql_error());
		if (mysql_num_rows($result)>0) {
			echo "That product ID already exists.  Please re-enter the new product.";
		} else {
			$sql = "INSERT INTO products (product_ID, prodTypeID, product_name, price) VALUES ('$id', '$cat' ,'$name', $price)";
			$result = mysql_query($sql) or die ("Could not add product.<br />\n".mysql_error()."<br />".$sql);
			if ($result) {
				echo "<h2>New product added: ".$name. ": ".$price."</h2>";
			} else {
				echo "Unable to add product.";
			}
		}
	}
?>
<form name="newProd" action="admin.php" method="post" onsubmit="return chkValsAddProd()">
    <input type="hidden" name="content" value="addProd" />
    <table width="75%" border="1" cellpadding="5">
        <tr>
        	<td id="tblHdr">Category</td>
            <td id="tblHdr">Product ID</td>
            <td id="tblHdr">Product Name</td>
            <td id="tblHdr">Product Abbr.</td>
            <td id="tblHdr">Price</td>
        </tr>
        <tr>
        	<td><select name="category"><option value=""></option>
				<?php while ($row=mysql_fetch_array($resultCat, MYSQL_ASSOC)) {
				echo "<option value=\"".$row["id"]." \">".$row["product_type"]."</option>";
				 }?></select></td>
            <td><input type="text" name="prodID" id="prodID" size="10" maxlength="15" /></td>
            <td><input type="text" name="prodName" id="prodName" size="20" /></td>
            <td><input type="text" name="prodAbbr" id="prodAbbr" size="20" /></td>
            <td>$<input type="text" name="price" id="price" size="5" maxlength="8" />
        </tr>
        <tr>
        	<td colspan="4"><input type="submit" value="Add Product" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" onclick="javascript:cancelEntry();" /></td>
        </tr>
    </table>
</td>