<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 16/12/2015
 * Time: 9:13 PM
 */

require_once("bookmark_fns.php");
do_html_header("Reset Password");

?>

<h3>Reset Password</h3>

<form method="post" action="forgot_passwd.php">
    <p>Enter Your username: <input type="text"></p>
    <input type="submit" name="Change Password">
</form>

<?php

do_html_footer();
