#!/usr/bin/php -q
<?php

// Copyright (C) 2017, Ward Mundy & Associates LLC with GPL3 license

include_once("config.php");

// Get cURL resource
$curl = curl_init();

$params = array(
        'grant_type' => 'password',
        'client_id' => $tesla_client_id,
        'client_secret' => $tesla_client_secret,
        'email' => $tesla_email,
        'password' => $tesla_password,
);

var_dump($params);

curl_setopt($curl, CURLOPT_URL, "https://owner-api.teslamotors.com/oauth/token");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

file_put_contents("token",$resp);
echo "Done. Tokens written to file: token";
echo $resp;
?>
