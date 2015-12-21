<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 13/12/2015
 * Time: 4:19 PM
 */

//this script ends a user session

//include function files for this application
require_once("bookmark_fns.php");
session_start();
$old_user = $_SESSION["valid_user"];

//store to test if they "were" logged on
unset($_SESSION["valid_user"]);
$result_dest = session_destroy();

//start output html
do_html_header("Logging out");

if(!empty($old_user)){
    if($result_dest){
        //if they were logged in and are now logged out
        echo "Logged out. <br />";
        do_html_url("login.php", "Login");
    } else {
        //they were logged in and could not be logged out
        echo "Could not log you out <br />";
    }
} else {
    //if they werent logged in but came to this page somehow
    echo "You were not logged in, and so have not been logged out. <br \>";
    do_html_url("login.php", "Login");
}

do_html_footer();

