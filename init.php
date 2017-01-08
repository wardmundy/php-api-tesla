<?php

//error_reporting(0);

// Copyright (C) 2017, Ward Mundy & Associates LLC with GPL3 license

//global variables
$TESLA_API_URL = "https://owner-api.teslamotors.com/";
$API_LAST_ERROR="";
$TOKEN="";
$ID=0;

function init() {

	global $TOKEN,$ID;

	// test for token existing first, before trying to read it
	if ( ! file_exists("token") ) {
	 echo "You first must generate a new token.\r\n";
	 echo "Run token.php and vehicle.php now.\r\n";
	 echo "Then try again.\r\n";
	 exit;
	}

	$tokendata=file_get_contents("token");
	$tokenjson = json_decode($tokendata);
	$expires=$tokenjson->created_at + $tokenjson->expires_in;

	if ( time() > $expires ) {
	 echo "Tokens are valid 3 months. Yours has expired.\r\n";
	 echo "You need to generate a new token.\r\n";
	 echo "Run token.php and vehicle.php now.\r\n";
	 echo "Then try again.\r\n";
	 exit;
	}

	$TOKEN=$tokenjson->access_token;

//       echo "TOKEN: ";
//       echo $TOKEN;
//       echo "\r\n";

	if (file_exists("vehicle")) $ID = file_get_contents("vehicle");

}

//general function to query the tesla API
function queryTeslaAPI ($token, $url,$post=false,$params="") {
    global $TESLA_API_URL,$API_LAST_ERROR;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $TESLA_API_URL.$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, $post);
    if (is_array($params)) curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Authorization: Bearer $token"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $response_array = json_decode ($response, true); // no worky with some long id's
//    $response_array = json_decode ($response, true,512, JSON_BIGINT_AS_STRING);

    $API_LAST_ERROR=$response_array;
    return $response_array["response"];
}

function ReadTeslaAPI($token,$carid) {

    global $TESLA_API_URL,$API_LAST_ERROR;

    $climate= queryTeslaAPI($token, "api/1/vehicles/".$carid."/data_request/climate_state");
    $drive= queryTeslaAPI($token, "api/1/vehicles/".$carid."/data_request/drive_state");
    $charge= queryTeslaAPI($token, "api/1/vehicles/".$carid."/data_request/charge_state");
    $state= queryTeslaAPI($token, "api/1/vehicles/".$carid."/data_request/vehicle_state");

    $api=array();
    $api["climate"]=$climate;
    $api["drive"]=$drive;
    $api["charge"]=$charge;
    $api["state"]=$state;

    $api["rated"]=(int)$charge["battery_range"];
    $api["soc"]=(int)$charge["battery_level"];
    $api["odometer"]=(int)$state["odometer"];
    $api["ctemp"]=$climate["outside_temp"] ;
    $api["temp"]=($climate["outside_temp"] * 9/5) + 32;

    $api["lat"]=$drive["latitude"];
    $api["lng"]=$drive["longitude"];

    return $api;
}

?>
