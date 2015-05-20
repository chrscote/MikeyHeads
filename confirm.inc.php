<?php
	if ($_SERVER['REQUEST_METHOD']!='POST') die ("No Post Variables");
	//Initialize the variables and add cmd key value pair
	$req = 'cmd=_notify-validate';
	//Read the POST from PayPal
	foreach ($_POST as $key=>$value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
	}
	//Now post this back to PayPal using curl and validate everything with PayPal.
	//Use CURL instead of PHP because fsockopen has issues in some environments.
	$url = "https://www.sandbox.paypal.com/cgi-bin/web-scr";
	//$url = "https://www.paypal.com/cgi-bin/web-scr";
	$curl_result = $curl_err = '';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length".strlen($req)));
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$curl_result = @curl_exec($ch);
	$curl_err = curl_error($ch);
	curl_close($ch);
	
	$req = str_replace("&", "<br>\n", $req);	//Make the request into a nice list
	//echo $req."<br /><br />\n";
	//echo $curl_result."<br /><br />".$curl_err;
	
	//Check that the result verifies
	if (strpos($curl_result, "VERIFIED") == 0) {
		$req = "<p>Thank you for your order, ". $_POST['first_name'].".</p>\n";
		if ($_POST["payment_type"]=="instant")
			$req .= "<p>Your purchase will appear on your statement as 'MIKEY HEADS'.\n";
		echo $req;
	} else {
		$req .= "\n\nData NOT verified from PayPal!";
		//mail("chrscote@99main.com", "", "$req", "From: MikeyHeads.com");
		echo "strpos(VERIFIED)=".strpos($curl_result, "VERIFIED");
		echo $curl_result."<br><br>".$curl_err;
	}
	
	/*
		CHECK THESE 4 THINGS BEFORE PROCESSING THE TRANSACTION
		1. Make sure that the business email returned is correct (mikeben07@yahoo.com)
		2. Make sure that the transaction payment status is 'completed'.
		3. Make sure there are no duplicate txn_id values.
		4. Make sure the payment matches the charges for the items.
	*/
	//CHECK #1
	$receiver_email = $_POST["receiver_email"];
	if ($receiver_email != "mikeben07@yahoo.com") {
		$message = "Investigate why receiver email is wrong. Email=".$_POST["receiver_email"]."\n\n\n$req";
		mail("chrscote@99main.com", "Receiver email incorrect", $message, "From: mikeyheads.com");
		echo $curl_err;
	}
	//CHECK #2
	if ($_POST["payment_status"]!= "Completed") {
		//Could simply be pending
	}
	
	//Connect to the database
	require_once 'connect_to_mysql.php';
	
	//CHECK #3
	$this_txn = $_POST["txn_id"];
	$sql = mysql_query("SELECT id FROM transactions WHERE txn_id='$this_txn' LIMIT 1");
	$numRows = mysql_num_rows($sql);
	$numRows = 0;
	if ($numRows>0) {
		$message = "Duplicate transaction ID occurred, so we killed the script.\n\n\n$req";
		mail("chrscote@99main.com", "Duplicate transaction ID", $message, "From: mikeyheads.com");
		echo $curl_err;
	}
	
	//CHECK #4
	$prodID_string = $_POST["custom"];
	$prodID_string = rtrim($prodID_string, ",");	//remove the last comma
	
	//Explode the string to make it an array, then query the prices and make sure the total matches payment_gross
	$id_str_array = explode(",", $prodID_string);
	$fullAmt = 0;
	$totalQuant = 0;
	foreach ($id_str_array as $key=>$value) {
		$id_quant_pair = explode("-", $value);	//Using hyphen as delimeter between id and quantity
		$prodID = $id_quant_pair[0];
		$prodQuant = $id_quant_pair[1];
		$totalQuant += $prodQuant;
		$prodPrice = 5 * $prodQuant;
		$fullAmt = $fullAmt + $prodPrice;
	}
	
	if ($totalQuant==1) {
		$shipping = 1.65;
	} else if ($totalQuant >= 2 && $totalQuant <= 3) {
		$shipping = 2.00;
	} else if ($totalQuant >= 4 && $totalQuant <= 5) {
		$shipping = 2.50;
	} else {
		$shipping=0;
	}
	$fullAmt += $shipping;
	$fullAmt *= 1.0635;		//Add sales tax
	$fullAmt = number_format($fullAmt, 2);
	$grossAmt = $_POST["payment_gross"];
	$grossAmt = number_format($grossAmt, 2);
	if ($fullAmt != $grossAmt) {
		$message = "Possible Price-Jacking: ". $_POST["payment_gross"]."!=$fullAmt\n\n\n$req";
		mail("chrscote@99main.com", "Price Jack or Bad Programming", $message, "From: mikeyheads.com");
		echo $message;
	} else {
		echo "  Your products will be shipped in 1-2 business days.</p>\n";
		//Now gather all important details sent back from PayPal
		$prodIDArray = $_POST["custom"];
		$payerEmail = $_POST["payer_email"];
		$firstName = $_POST["first_name"];
		$lastName = $_POST["last_name"];
		$payDate = $_POST["payment_date"];
		$payDate = date("Y-m-d", strtotime($payDate));
		$mcGross = $_POST["mc_gross"];
		$txnID = $_POST["txn_id"];
		$pymtType = $_POST["payment_type"];
		$pymtStatus = $_POST["payment_status"];
		$txtType = $_POST["txn_type"];
		$payerStatus = $_POST["txn_id"];
		$addrStreet = $_POST["address_street"];
		$addrCity = $_POST["address_city"];
		$addrState = $_POST["address_state"];
		$addrZip = $_POST["address_zip"];
		$payerID = $_POST["payer_id"];
		
		//echo $payDate;
		$sql = "INSERT INTO transactions (product_id_array, payer_email, first_name, last_name, payment_date, mc_gross, txn_id, payment_type, payment_status, txn_type, payer_status, address_street, address_city, address_state, address_zip, payer_id) ";
		$sql.= "VALUES ('$prodIDArray', '$payerEmail', '$firstName', '$lastName', '$payDate', '$mcGross', '$txnID', '$pymtType', '$pymtStatus', '$txtType', '$payerStatus', '$addrStreet', '$addrCity', '$addrState', '$addrZip', '$payerID')";
		$result = mysql_query($sql) or die ("Unable to insert transaction. ".mysql_error()."<br />\n");
		if ($result) {
			echo "<p>Your transaction number is: <b>$txnID</b>.  Keep this information for your records.</p>";
		} else {
			echo "Unable to add transaction";
		}
	}
		
	//session_unset();
	session_destroy();
?>