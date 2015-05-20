<?php
	//DB Variables
	$host = "localhost";
	$user="";
	$pw = "";
	$db_name="mikeyHead";
	
	//PayPal settings
	$paypal_email = 'mikeben07@yahoo.com';
	$return_url = "http://www.mikeyheads.com/index.php?content=success";
	$cancel_url = "http://www.mikeyheads.com/index.php?content=cancel";
	$notify_url = "http://www.mikeyheads.com/index.php?content=payments";
	
	$item_name="Test Item";
	$item_amount = 4.75;
	
	include ("functions.php");
	$link = mysql_connect($host, $user,$pw);
	mysql_select_db($db_name);
	$queryStr = "";
	//Check if paypal request or response
	if (!isset($_POST["txn_id"])&&!isset($_POST["txn_type"])) {
		//First append paypal account to querystring
		$queryStr .= "?business=".urlencode($paypal_email)."&";
		//Append amount and currency to querystring
		$queryStr .= "mc_gross=".$_POST["totalSale"]."&";
		$queryStr .= "mc_currency=USD&";
		
		foreach ($_SESSION["hCart"] as $prod=>$quantity) {
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
			$prod = $prodSize . " oz. ". $prodColor." ".$prodType;
			$queryStr .= "item_name=".urlencode($prod)."&";
			$queryStr .= "amount=".$quantity*4.75."&";
		}
		$queryStr .= "return=".urlencode(stripslashes($return_url))."&";
		$queryStr .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
		$queryStr .= "notify_url=".urlencode(stripslashes($notify_url));
		
		//Redirect to paypal IPN
		header("location:https://www.sandbox.paypal.com/cgi-bin/webscr".$queryStr);
		exit();
	} else {
		//Read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $ey=>$value) {
			$value = urlencode(stripslashes($value));
			$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
			$req .="&".$key."=".$value;
		}
		
		//assign posted variables to local variables
		$data['item_name'] = $_POST['item_name'];
		$data['item_number'] = $_POST['item_number'];
		$data['payment_status'] = $_POST['payment_status'];
		$data['payment_amount'] = $_POST['payment_amount'];
		$data['payment_currency'] = $_POST['payment_currency'];
		$data['txn_id'] = $_POST['txn_id'];
		$data['receiver_email'] = $_POST['receiver_email'];
		$data['payer_email'] = $_POST['payer_email'];
		$data['custom'] = $_POST['custon'];
		
		//post back to PayPal to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Length: ".strlen($req)."\r\n\r\n";
		$fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
		
		if (!$fp) {
			//HTTP ERROR
		} else {
			mail("chrscote@99main.com", "0", "0");
			fputs($fp, $header.$req);
			while (!feof($fp)) {
				$res = fgets($fp, 1024);
				if (strcmp($res, "VERIFIED")==0) {
					//Validate payment
					$valid_txnid = check_txnid($data["txn_id"]);
					$valid_price = check_price($data["payment_amount"], $data['item_number']);
					
					//Payment validated and verified!!
					if ($valid_txnid && $valid_price) {
						$orderID = updatePayments($data);
						if ($orderID) {
							//Payment hs been made and inserted into database
						} else {
							//error inserting into DB.
							//Email admin and alert user
						}
					} else {
						//Payment made but data has been changed
						//Email admin and alert user
					}
				}else if (strcmp($res, "INVALID")==0) {
					//Payment invalid
				}
			}
			fclose($fp);
		}
	}
?>