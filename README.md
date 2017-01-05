# php-api-tesla
PHP Application Library for Tesla API

1. Install all files in a secure directory on your LAMP server: git clone https://github.com/wardmundy/php-api-tesla.git

2. Run scripts from command line only! Switch to php-api-tesla directory before proceeding.

3. Manually edit config.php and insert your credentials and desired settings.

4. Before doing anything else, run these two scripts in the following order:

./token.php
./vehicle.php

All of the rest of the scripts will then work properly for 90 DAYS, 
e.g. ./vehicle_state.php

NOTE: TOKENS last for 90 days! After 90 days, you must rerun token.php and vehicle.php
