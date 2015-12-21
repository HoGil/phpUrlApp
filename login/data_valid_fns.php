<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 12/12/2015
 * Time: 8:58 PM
 */

//functions that are used to validate input form data

function filled_out($form_vars){
    //test that each field has a value
    foreach($form_vars as $key => $value){
        if((!isset($key)) || ($value == "")){
            return false;
        }
    }
    return true;
}

function valid_email($address){
    //check that an email is possibly valid
    if(ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address)){
        return true;
    } else {
        return false;
    }
}