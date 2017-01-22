#!/usr/bin/php -q
<?php

// Copyright (C) 2017, Ward Mundy & Associates LLC with MIT license

include("config.php");
include("init.php");

init();

$params = array("on" => true, "password" => $valet_pin);

$response =queryTeslaAPI($TOKEN, "api/1/vehicles/".$ID."/command/set_valet_mode",true,$params);

var_export($response);

?>

