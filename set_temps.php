#!/usr/bin/php -q
<?php

include_once("config.php");

$token = file_get_contents("token");
$token = substr($token,17);
$pos = strpos($token,'"');
$token=substr($token,0,$pos);

$id = file_get_contents("vehicle");
$pos = strpos($id,'"id":');
$id = substr($id,$pos+5);
$pos = strpos($id,',');
$id=substr($id,0,$pos);

$params = array('driver_temp' => $driver_temp, 'passenger_temp' => $passenger_temp);

var_dump($params);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://owner-api.teslamotors.com/api/1/vehicles/$id/command/set_temps");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
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
