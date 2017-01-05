#!/usr/bin/php -q
<?php
$token = file_get_contents("token");
$token = substr($token,17);
$pos = strpos($token,'"');
$token=substr($token,0,$pos);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://owner-api.teslamotors.com/api/1/vehicles");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Authorization: Bearer $token"
));

$response = curl_exec($ch);
curl_close($ch);

file_put_contents("vehicle",$response);
echo "Done. Vehicle info written to file: vehicle";
echo "\r\n";

//var_dump($response);

$sep=chr(13).chr(10);
$result=str_replace(',',$sep,$response);
echo $result;
echo "\r\n\n";



echo "\r\n";
?>

