<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 12/12/2015
 * Time: 10:16 PM
 */

function db_connect(){
    //returns a db connection

    $result = mysqli_connect("localhost", "bm_user", "Apple3509", "bookmarks");


    if(!$result){
        throw new Exception("Could not connect to database server");
    } else {
        return $result;
    }

}