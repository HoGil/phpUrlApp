<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 10/12/2015
 * Time: 9:46 PM
 */
// receive data from register_form.php (well actually the function) and process that into mySql

require_once("bookmark_fns.php");

//first set the variables
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];


//start session now because it must go before headers
session_start();

try{
    //so if any of these fail, then it will fall to the catch block

    //check forms filled in
    if(!filled_out($_POST)){ // this function is in data_valid_fns.php
        throw new Exception("You have not filled the form out correctly - please try again.");
    }

    //email address not valid
    if(!valid_email($email)){ // this is in data_valid_fns.php
        throw new Exception("Not valid email address. Please go back and try again.");
    }

    //passwords not the same
    if($password != $cpassword){
        throw new Exception("Passwords dont match. Please go back and try again.");
    }

    //check password length is ok
    //ok if username truncates, but passwords will get munged if they are too long
    if((strlen($password) < 6) || (strlen($password) > 16)){
        throw new Exception("Your password must be between 6 and 16 characters. Try again.");
    }

    //attempt to register
    //this function can also throw an exception
    register($username, $email, $password); //if this fails, it will throw exception and caught in catchblock
    //register session variable
    $_SESSION["valid_user"] = $username; //you are registering the username as a session variable

    //provide link to members page
    do_html_header("Registration Successful");
    echo "Your registration was successful. Go to the members page to start setting up your bookmark!";
    do_html_url("member.php", "Go to members page");

    //end page
    do_html_footer();

} catch (Exception $e){
    do_html_header("Problem: ");
    echo $e->getMessage();
    do_html_footer();
    exit;
}




