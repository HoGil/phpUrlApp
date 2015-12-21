<?php
/**container for five other include files
 We can include this file in all our files
 * this way, every file will contain all our functions and exceptions
 */

require_once("data_valid_fns.php");
require_once("db_fns.php");
require_once("user_auth_fns.php");
require_once("output_fns.php");
require_once("url_fns.php");

//we structured the project like this because the functions fall into logical groups
//We constructed this file because you will use most of the five function files
//in most of the scripts. Including this one file in each script is easier than having five
//require statements
