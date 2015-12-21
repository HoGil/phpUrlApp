<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 14/12/2015
 * Time: 8:37 PM
 */

require_once("bookmark_fns.php");
session_start();

do_html_header("Change Password");
display_passwd_form();
display_user_menu();
do_html_footer();



