#!/usr/bin/php -q
<?php

// Copyright (C) 2017, Ward Mundy & Associates LLC with MIT license

include("init.php");

init();

$params = array('driver_temp' => $driver_temp, 'passenger_temp' => $passenger_temp);

$response =queryTeslaAPI($TOKEN, "api/1/vehicles/".$ID."/command/set_temps",true,$params);

var_export($response);

?>
