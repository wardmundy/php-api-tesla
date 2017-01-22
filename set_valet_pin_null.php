#!/usr/bin/php -q
<?php

// Copyright (C) 2017, Ward Mundy & Associates LLC with MIT license

include("init.php");

init();

$response =queryTeslaAPI($TOKEN, "api/1/vehicles/".$ID."/command/reset_valet_pin",true);

var_export($response);

?>
