#!/usr/bin/php -q
<?php

$token = file_get_contents("token");
$token = substr($token,17);
$pos = strpos($token,'"');
$token=substr($token,0,$pos);

$id = file_get_contents("vehicle");
$pos = strpos($id,'"id":');
$id = substr($id,$pos+5);
$pos = strpos($id,',');
$id=substr($id,0,$pos);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://owner-api.teslamotors.com/api/1/vehicles/$id/data_request/vehicle_state");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Authorization: Bearer $token"
));
$response = curl_exec($ch);
curl_close($ch);

//echo var_dump($response);

echo "\r\n\n";
$sep=chr(13).chr(10);
$result=str_replace(',',$sep,$response);
echo $result;
echo "\r\n\n";
?>

