<?php
	if (isset($_POST["category"])) {
		$cat = $_POST["category"];
		$Ucat = strtoupper($cat);
		$sqlSel = "SELECT * FROM productTypes WHERE UCASE(product_type) LIKE '%".$Ucat."%'";
		$result = mysql_query($sqlSel) or die ("Could not query database. ".mysql_error());
		//echo $sqlSel."<br />\n";
		if (mysql_num_rows($result)>0) {
			echo "That product category (or a similar one) already exists.  Please re-enter the new product.";
		} else {
			$sql = "INSERT INTO productTypes (product_type) VALUES ('$cat')";
			$result = mysql_query($sql) or die ("Could not add category.<br />\n".mysql_error()."<br />".$sql);
			if ($result) {
				echo "<h2>New category added: ".$cat. "</h2>".$sql;
			} else {
				echo "Unable to add category.";
			}
		}
	}
?>
<form name="newCat" action="admin.php" method="post" onsubmit="return chkValsAddCat()">
    <input type="hidden" name="content" value="addCat" />
    <table width="75%" border="1" cellpadding="5">
        <tr>
            <td id="tblHdr">Category: </td>
            <td><input type="text" name="category" id="category" size="10" maxlength="30" /></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Add Category" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" onclick="javascript:cancelEntry();" /></td>
        </tr>
    </table>
</td>