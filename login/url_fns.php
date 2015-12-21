<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 12/12/2015
 * Time: 11:52 PM
 */

function do_html_url($path, $title){

    ?>

<p><a href="<?php echo $path; ?>"><em><?php echo $title; ?></em></a></p>

<?php


}

function get_user_urls($username){
    //gets a users urls from the database
    //the variable argument is the username of the user (ie gilho)

    $conn = db_connect();

    //get the urls
    $result = $conn -> query("SELECT bm_URL FROM bookmark WHERE username = '".$username."'");
    if(!$result){
        //not value in the system
        throw new Exception("There are no saved URLs. Add some!");
    }

    if($result -> num_rows > 0){
        return $result;
    } else {
        
        echo "There are no saved URLs. Why dont you add some!";

    } 

}

function add_bm($url){

    //session_start() not included here as it has already been started

    $username = $_SESSION["valid_user"];

    try {
         //first check if there is a dupblicate email
        $conn = db_connect();
        $result = $conn -> query("SELECT * FROM bookmark WHERE bm_URL = '$url'");
        //continue

        if($result -> num_rows > 0){
            echo "This URL already exists. Please save another.";
        } 

        $result = $conn -> query("INSERT INTO bookmark VALUES ('$username', '$url')");

        if(!$result){
            throw new Exception("Error adding URL to DB");
            
        }

    } catch(Exception $e) {
        throw new Exception("Error Processing Request");
        
    }

}

function delete_bm($username, $url){
    //delete one url from the database

    $conn = db_connect();

    $result = $conn -> query("DELETE FROM bookmark WHERE bm_URL = '$url'");
    if(!$result){
        throw new Exception("Could not delete");
        
    }

    return true;


}