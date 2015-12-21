<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 12/12/2015
 * Time: 11:54 PM
 */

//this script is called from the login page and logs them in.
//it also takes the form info and processes it
//IT IS THE CENTER FOR THE REST OF THIS APPLICATION


//include function files for this application
require_once("bookmark_fns.php");
session_start();

//create short variable names
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

//first check whether the user has come from the front page by filling out the form
if($username && $password){
    //they have just tried to log in
    try{
        login($username, $password);
        //if they are in the database (as in they are a member), register their username to the session ID variable called valid_user
        $_SESSION["valid_user"] = $username;
    } catch(Exception $e){
        //unsuccessful login
        do_html_header("Problem: ");
        echo "We could not log you in. You must be logged in to view this page.";
        do_html_url("login.php", "Login");
        do_html_footer();
        exit;
    }
}

//start the display
do_html_header("Home");
check_valid_user();
//get the bookmarks this user has saved
if($url_array = get_user_urls($_SESSION["valid_user"])){ //gilho instead of session valid user
    display_user_urls($url_array);
}

//give menu options
display_user_menu();

do_html_footer();

