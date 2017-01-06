#!/usr/bin/php -q
<?php
error_reporting(0);

$timenow = time();

$tokendata = file_get_contents("token");
$created = $tokendata;
$pos = strpos($created,'created_at":');
$created = substr($created,$pos+12);
$pos = strpos($created,'}');
$created=substr($created,0,$pos);

$expires = $tokendata;
$pos = strpos($expires,'expires_in":');
$expires = substr($expires,$pos+12);
$pos = strpos($expires,',');
$expirelen=substr($expires,0,$pos) - 300;
$expires=$expirelen + $created;

if ( ! file_exists("token") ):
 echo "You firt must generate a new token.";
 echo "\r\n";
 echo "Run token.php and vehicle.php now.";
 echo "\r\n";
 echo "Then try again.";
 echo "\r\n";
 exit;
elseif ( $timenow > $expires ):
 echo "Tokens are valid 3 months. Yours expired.";
 echo "\r\n";
 echo "You need to generate a new token.";
 echo "\r\n";
 echo "Run token.php and vehicle.php now.";
 echo "\r\n";
 echo "Then try again.";
 echo "\r\n";
 exit;
endif;

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
