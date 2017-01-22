#!/usr/bin/php -q
<?php

// Copyright (C) 2017, Ward Mundy & Associates LLC with MIT license

include("init.php");

init();

$response =queryTeslaAPI($TOKEN, "api/1/vehicles/".$ID."/command/wake_up",true);

var_export($response );

?>
