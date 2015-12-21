<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 14/12/2015
 * Time: 8:57 PM
 */

//THIS SCRIPT CHANGES USER PASSWORD


require_once("bookmark_fns.php"); //didnt know I needed this
session_start(); //was wondering whether I needed this
do_html_header("Change Password");

//set the variables
$oldpassword = $_POST["oldpword"];
$newpassword = $_POST["newpword"];
$newcpassword = $_POST["cpword"];
$username = $_SESSION["valid_user"];

/*
 *  1. Confirm validity of password
 *  2. See if second and third ones are identical
 *  3. delete original password from db
 *  4. insert new password into db
 */

try{

    check_valid_user();
    if(!filled_out($_POST)){
        throw new Exception("You have not filled out the form completely. Please try again.");
    }

    if($newcpassword != $newpassword){
        throw new Exception("Your passwords dont match. Please try again");
    }

    if((strlen($newpassword) > 16 || strlen($newpassword) < 6)){
        throw new Exception("New password must be between 6 and 16 characters. Please try again.");
    }

    change_password($_SESSION["valid_user"], $oldpassword, $newpassword);
    echo "Password changed";


} catch (Exception $e){
    echo $e->getMessage();
}

echo

display_user_menu();
do_html_footer();






