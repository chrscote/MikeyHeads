<?php
	if (isset($_POST["txnID"])) {
		//Display values for edit
		$sql = "SELECT * FROM transactions WHERE txn_id='".$_POST["txnID"]."'";
		$result = mysql_query($sql);
		if (mysql_num_rows($result)>0) {
			$row=mysql_fetch_array($result, MYSQL_ASSOC);
			
			$prodIDArr = $row["product_id_array"];
			$prodIDArr = substr($prodIDArr, 0, strlen($prodIDArr)-1);
			$prodArr = explode(",", $prodIDArr);
?>
<table>
	<tr>
    	<td id="tblHdr">Name</td>
        <td id="tblHdr">Address</td>
        <td id="tblHdr">E-Mail</td>
        <td id="tblHdr">Products Bought</td>
        <td id="tblHdr">Date of Purchase</td>
        <td id="tblHdr">Transaction #</td>
        <td id="tblHdr">Total Sale</td>
        <td id="tblHdr">Status</td>
    </tr>
    <tr>
    	<td><?php echo $row["first_name"]." ".$row["last_name"]?></td>
    	<td><?php echo $row["address_street"]."<br />".$row["address_city"].", ".$row["address_state"]." ".$row["address_zip"]?></td>
    	<td><?php echo $row["payer_email"]?></td>
    	<td><?php foreach ($prodArr as $prodQuant) {
				$prod = substr($prodQuant, 0, strPos($prodQuant, "-"));
				$quant = substr($prodQuant, strPos($prodQuant, "-")+1);
				$prodSql = "SELECT prod_abbr FROM products WHERE product_ID='".$prod."'";
				$prodResult = mysql_query($prodSql);
				if ($prodResult) {
					$prodRow = mysql_fetch_array($prodResult, MYSQL_ASSOC);
					$prod = $prodRow["prod_abbr"];
				} else {
					$prod = "No name";
				}
				echo $prod." - ".$quant."<br />\n";
			}?></td>
    	<td><?php echo $row["payment_date"]?></td>
    	<td><?php echo $row["txn_id"]?></td>
    	<td align="center">$<?php echo $row["mc_gross"]?></td>
    	<td><?php echo $row["payment_status"]?></td>
    </tr>
</table>
<?php
		} else {
?>		
<p>That Transaction # does not exist.</p>
<?php		}
	}
		//Give text box for admin to enter Transaction Number.
?>
	<form name="txnNum" action="admin.php?content=txns" method="post">
	<table>
    	<tr>
        	<td><b>Transaction #: </b></td>
            <td><input type="text" name="txnID" id="txnID" size="20" maxlength="40" />&nbsp;<input type="submit" value="Search" /></td>
        </tr>
    </table>
    </form>
<table cellspacing="6">
	<tr>
    	<td id="tblHdr">Name</td>
        <td id="tblHdr">Address</td>
        <td id="tblHdr">E-Mail</td>
        <td id="tblHdr">Products Bought</td>
        <td id="tblHdr">Date of Purchase</td>
        <td id="tblHdr">Transaction #</td>
        <td id="tblHdr">Total Sale</td>
        <td id="tblHdr">Status</td>
    </tr>
<?php
	$sql = "SELECT id, payer_id, first_name, last_name, payment_date, product_id_array, payer_email, mc_gross, txn_id, address_street, address_city, address_state, address_zip, payment_status FROM transactions ORDER BY payer_id, payment_date";
	$result = mysql_query($sql);
	$currPayerID = "";
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$id = $row["id"];
		$payerID = $row["payer_id"];
		if ($currPayerID != $payerID) {
			$sqlOrders = "SELECT payer_id FROM transactions WHERE payer_id='$payerID'";
			$resultOrders = mysql_query($sqlOrders);
			if ($resultOrders) {
				$numOrders = mysql_num_rows($resultOrders);
				$numOrders = 2*$numOrders-1;
			} else {
				$numOrders = 1;
				echo $sqlOrders."<br />";
			}
			$currPayerID = $payerID;
			$street = $row["address_street"];
			$city = $row["address_city"];
			$state = $row["address_state"];
			$zip = $row["address_zip"];
			$email = $row["payer_email"];
		} else {
			$payerID = "";
			$street = "";
			$city = "";
			$state = "";
			$zip = $email = "";
		}
		$prodIDArr = $row["product_id_array"];
		$prodIDArr = substr($prodIDArr, 0, strlen($prodIDArr)-1);
		$prodArr = explode(",", $prodIDArr);
		$firstName = $row["first_name"];
		$lastName = $row["last_name"];
		$date = strtotime($row["payment_date"]);
		$date = date('m/d/y',$date);
		$amt = $row["mc_gross"];
		$txnID = $row["txn_id"];
		$status = $row["payment_status"];
		if ($payerID !="" && $currPayerID!="") {
?>
	<tr>
    	<td colspan="8"><img src="../images/trnsp.gif" width="1" height="15" border="0" /></td>
    </tr>
<?php
		}
?>
	<tr>
<?php
		if ($payerID!="") {
?>
    	<td valign="top" rowspan="<?php echo $numOrders?>"><?php echo $firstName."<br />".$lastName ?></td>
        <td valign="top" rowspan="<?php echo $numOrders?>"><?php if ($street != "") 
			echo $street."<br />\n".$city.", ".$state." ".$zip;
		?></td>
        <td valign="top" rowspan="<?php echo $numOrders?>"><?php echo $email ?></td>
<?php
		}
?>
        <td><?php 
			foreach ($prodArr as $prodQuant) {
				$prod = substr($prodQuant, 0, strPos($prodQuant, "-"));
				$quant = substr($prodQuant, strPos($prodQuant, "-")+1);
				$prodSql = "SELECT prod_abbr FROM products WHERE product_ID='".$prod."'";
				$prodResult = mysql_query($prodSql);
				if ($prodResult) {
					$prodRow = mysql_fetch_array($prodResult, MYSQL_ASSOC);
					$prod = $prodRow["prod_abbr"];
				} else {
					$prod = "No name";
				}
				echo $prod." - ".$quant."<br />\n";
			}
			 ?></td>
        <td align="center"><?php echo $date ?></td>
        <td><?php echo $txnID ?></td>
        <td align="center">$<?php echo $amt ?></td>
        <td><?php echo $status ?></td>
    </tr>
<?php
		$numOrders=$numOrders-2;
		if ($numOrders!=0)
?>
    <tr>
    	<td colspan="2"><img src="../images/trnsp.gif" width="1" height="5" border="0" /></td>
    </tr>
<?php	
	}
?>
</table>