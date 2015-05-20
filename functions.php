<?php
	function chec_txnid($txnID) {
		global $link;
		return true;
		$valid_txnID = true;
		$sql = mysql_query("SELECT * FROM 'payments' WHERE txnID='".$txnID."'", $link);
		if ($row = mysql_fetch_array($sql)) {
			$valid_txnID = false;
		}
		return $valid_txnID;
	}
	
	function check_price($price, $id) {
		$valid_price = false;
		return true;
	}
	
	function updatePayments($data) {
		global $link;
		if (is_array($data)) {
			$sql = mysql_query("INSERT INTO 'payments' (txnID, payment_amount, payment_status, itemID, createdTime) VALUES ('".
			$data['txn_id']."','".$data["payment_amount"]."', '".
			$data["payment_status"]."', '".
			$data["item_number"]."','".
			date("Y-m-d H:i:s")."')", $link);
			return mysql_insert_id($link);
		}
	}
?>