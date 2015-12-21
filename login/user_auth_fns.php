<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 12/12/2015
 * Time: 9:24 PM
 */



function register($username, $email, $password){
    //register new person to DB
    //return true or error message

    //connect to db
    $conn = db_connect();

    //check if username is unique
    $result = $conn -> query("select * from user where username='$username'");
    //note $conn -> query means in the $conn array variable, there will be a query field.
    // in that query field, chuck in this line

    if(!$result){
        throw new Exception("Could not execute query");
    }

    if($result->num_rows>0){
        throw new Exception("That username is taken - go back and choose another one");
    }

    //if ok put in db
    $result = $conn->query("INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')");
    if(!$result){
        throw new Exception("Could not register you in database. Please try again.");
    }

    return true;

}

function login($username, $password){
//essentially checking whether the username and password are in the database?? no

    $conn = db_connect();
    $result = $conn -> query("SELECT * FROM user WHERE username = '".$username."' AND password='".$password."'");
    if(!$result){
        //no value means not in system
        throw new Exception("You are not a member. Please register at " . do_html_url("register.form", "Registration"));
    }

    if($result -> num_rows > 0){
        return true;
    } else {
        throw new Exception("Could not log you in.");
    }

}

function check_valid_user(){
//checks that current user has a registered session. This is aimed at users who have not just logged in,
    //but are mid-session. So does not connect to db again

    //see if somebody is logged in and notify them if not
    if(isset($_SESSION["valid_user"])){
        echo "";
        echo "Logged in as ".$_SESSION["valid_user"].".<br /n>";
    } else {
        //they are not logged in
        do_html_header("Problem: ");
        echo "You are not logged in. <br />";
        do_html_url("login.php", "Login");
        do_html_footer();
        exit;
    }

}

function change_password($username, $oldpassword, $newpassword){
//change password from old to new
    //return true or false



    $conn = db_connect();
    $result = $conn-> query("UPDATE user SET password='$newpassword' WHERE username = '$username' ");

    if(!$result){
        throw new Exception("Could not update db with new password. Please try again.");
    }

    return true;

}

function reset_password($username){
    //generates a random password for the user and puts it into the database

    //first generate a random password
    $randomPassword = randomPassword();

    $conn = db_connect();
    $result = $conn -> query("UPDATE user SET password='$randomPassword' WHERE username = '$username' ");

    if(!$result){
        throw new Exception("Could not reset password. Please try again.");
    }

    return $randomPassword;

}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function notify_password($username, $password){

    //Notify the user that the password has been changed

    $conn = db_connect();
    $result = $conn -> query("SELECT email FROM user WHERE username='$username'");
    if(!$result){
        throw new Exception("Could not find email address.");
    } elseif($result ->num_rows == 0){
        //username not in db
        throw new Exception("Could not find email address");
    } else {
        $row = $result->fetch_object(); //get the current row of the result as an object
        $email = $row->email; //pretty much doing row.email in java
        $from = "From: support@phpbookmark \r\n";
        $mesg = "Your PHPbookmark password has been changed to " . $password . "\r\n" . "Please chage it next time you log in. \r\n";

        if(mail($email, "PHPBookmark login information", $mesg, $from)){
            return true; //if it has been sent, return true
        } else {
            throw new Exception("Could not send email.");
        }

    }



    return true;
}