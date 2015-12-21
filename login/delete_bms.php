<?php

require_once("bookmark_fns.php");
session_start();

//create short variable names
$del_array = $_POST["deleteurl"];
$valid_user = $_SESSION["valid_user"];

do_html_header("Deleting bookmarks");
check_valid_user();

if(!filled_out($_POST)){
	echo "<p>You have not chosen any bookmarks to delete. <b \>	
		 	please try again later. </p>";

	display_user_menu();
	do_html_footer();
	exit();
} else {
	if(count($del_array) > 0){
		foreach ($del_array as $url) {
			if(delete_bm($valid_user, $url)){
				echo "Deleted" .$url."<br />"; 
			} else {
				echo "Could not delete" . $url ."<br />";
			}
		}
	} else {
		echo "No bookmarks selected for deletion";
	}
}

//get the bookmarks this user has saved
if($url_array = get_user_urls($valid_user)){
	display_user_urls($url_array);
}

display_user_menu();
do_html_footer();
