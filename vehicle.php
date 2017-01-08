#!/usr/bin/php -q
<?php

// Copyright (C) 2017, Ward Mundy & Associates LLC with GPL3 license

error_reporting(0);

include("init.php");

init();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://owner-api.teslamotors.com/api/1/vehicles");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Authorization: Bearer $TOKEN"
));
$response = curl_exec($ch);
curl_close($ch);

$pos = strpos($response,'"id":');
$id = substr($response,$pos+5);
$pos = strpos($id,',');
$id=substr($id,0,$pos);


file_put_contents("vehicle",$id);
echo "Vehicle id written to file: vehicle";
echo "\r\n";

file_put_contents("vehicleinfo",$response);
echo "Vehicle info written to file: vehicleinfo";
echo "\r\n";

//var_dump($response);

$sep=chr(13).chr(10);
$result=str_replace(',',$sep,$response);
echo $result;
echo "\r\n\n";

echo "\r\n";
?>
