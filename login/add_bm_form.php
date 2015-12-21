<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 17/12/2015
 * Time: 9:30 PM
 */

//using output functions, display a form to add bookmarks

session_start();
$username = $_SESSION["valid_user"];
require_once("output_fns.php");
do_html_header("Add Bookmarks");

?>

<h3>Add Bookmarks</h3>
<p>Logged in as <?php echo $username?></p>

<form method="post" action="add_bms.php">
    <p>New BM: <input type="text" name="newbm" value="http://" \></p>
    <input type="submit" value="Add bookmark" \>
</form>

<?php

display_user_menu();
do_html_footer();

