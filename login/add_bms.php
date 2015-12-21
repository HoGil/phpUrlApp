<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 17/12/2015
 * Time: 9:35 PM
 */

//adds newly added bookmark to the db and then returns to the home page
require_once("bookmark_fns.php");
session_start();
$username = $_SESSION["valid_user"];
$bookmark = $_POST["newbm"];
do_html_header("Adding bookmarks");
//use try catch when you think the whole process is a little risky and heaps of possible errors

try{
    check_valid_user(); //cant forget this right?
    if(!filled_out($_POST)){
        throw new Exception("Form not completely filled out.");
    }

    //check URL format
    if(strstr($bookmark, "http://") === false){
        $bookmark = "http://" . $bookmark;
    }

    //check URL is valid
    if(!(@fopen($bookmark, "r"))){
        throw new Exception("Not a valid URL");
    }

    //try to add BM
    add_bm($bookmark);
    echo "Bookmark added";

    //get the bookmarks this user has saved
    if($url_array = get_user_urls($_SESSION["valid_user"])){
        display_user_urls($url_array);
    }

} catch (Exception $e){
    echo $e->getMessage();
}

display_user_menu();
do_html_footer();
