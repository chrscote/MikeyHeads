<?php
$ch = curl_init();
$clientId = "AXZ9MhBOxZPOD62PWxd3cD9ZFZVF3sZfHY_hLDIXDDj5mpDql-TPWqwQaqxZ";
$secret = "EBHiPRCG3tNCcOI2p7LcmKfjHTnJWPbyULGmHsa0fhvaQ1Jw9a0W-YB6QG94";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);

if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
    print_r($json->access_token);
}

curl_close($ch);
?>