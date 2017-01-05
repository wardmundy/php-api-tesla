# php-api-tesla
PHP Application Library for Tesla API

1. Install all files in a secure, dedicated tesla directory on your LAMP server. Run scripts from command line only!

2. Manually edit config.php and insert your credentials and desired settings.

3. After switching to tesla directory, run these two scripts in the following order:

./token.php
./vehicle.php

All of the rest of the scripts will then work properly for 90 DAYS, 
e.g. ./vehicle_state.php

NOTE: TOKENS last for 90 days! After 90 days, you must rerun token.php and vehicle.php
