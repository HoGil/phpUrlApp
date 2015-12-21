<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 9/12/2015
 * Time: 8:46 PM
 */

function do_html_header($title){
//print an HTML header or add appropriate title to heading page
    ?>

    <html>
    <head>
        <title><?php echo $title;?></title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 13px
            }

            li, td {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 13px
            }

            p{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px
            }

            hr {
                color: #3333cc;
                width: 300px;
                text-align: left
            }

            a {
                color: #000000
            }

            input{
                align-content: center;
                align: left
            }

            form {
                background-color: lightgray;
                padding: 20px 116px 20px 20px;
                width: 212px;

            }

            th{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 15px;
                font-weight: bold;
                border-bottom: solid #000000 1px;

            }

            table{
                margin-left: -3px;
                border: lightgrey;
            }

            tr{
                background-color: lightgrey;
            }

            td{
                height: 10px;
            }
        </style>
    </head>
    <body>
    <img src="sunlogo.jpg" alt="Sun Logo" border="0" align="left" valign="bottom" height="55" width="57"/>

    <h1>Suncorp Logo - Bookmarks</h1>

    <hr/>

    <?php
    //if ($title) { //if title exists
       // do_html_heading($title);
    //}

}

function display_site_info(){

    ?>

    <ul>
        <li style="font-size: 15px">Store your bookmarks online with us!</li>
        <li style="font-size: 15px">See what other users use!</li>
        <li style="font-size: 15px">Share your favourite links with others!</li>
    </ul>

    <?php
}

function display_login_form(){

    ?>

    <!-- Not a Member link link to registration form site-->
    <p><a href="register_form.php">Not a member?</a></p>

    <form method="post" action="member.php" style="background-color: lightgray; width: 280px; padding: 27px"> <!-- Leave this blank for now -->
        <p>Username: <input type="text" name="username"></p>
        <p>Password: <input type="password" name="password"></p>
        <input type="submit" value="Log in">
    </form>

    <!-- Forgot your password? link to change password module -->
    <p style="text-decoration: underline"><a href="forgot_form.php">Forgot your password?</a></p>


    <?php

}

function do_html_footer(){

    ?>

    </body>
    </html>



    <?php

}

function display_registration_form(){
// This is the actual registration form HTML. It will call the register_new.php file
    // that other file will do the backend side of things.
    //MY ATTEMPT
    ?>



<h1>User Registration</h1>
<form method="post" action="register_new.php" style="background-color: lightgray; width: 280px; padding: 27px">
    <p style="margin-bottom: -12px">Email address: </p><br/><input type="email" name="email">
    <p style="margin-bottom: -12px">Preferred username (max 16 chars): </p><br/><input type="text" name="username">
    <p style="margin-bottom: -12px">Password: </p><br/><input type="password" name="password">
    <p style="margin-bottom: -12px">Confirm password:</p><br/><input type="password" name="cpassword">
    <input type="submit" value="Register">
</form>

<?php

}

function display_user_urls($url_array){
    //outputs the bookmarks/urls to the browser in a table
    //MY ATTEMPT

    //start a table - first with a header
    ?>
<table>
    <tr>
        <th>Bookmark</th>
        <th>Delete?</th>
    </tr>

    <?php

    //split the results into records
    while($row = mysqli_fetch_assoc($url_array)){
        print " <tr> \n";
        foreach($row as $name => $value){
            print "     <td><a href='$value'>$value</a></td>     \n";
            print "     <td><input type='checkbox' name='deleteurl[]' value='<?php $value?>'></td>";
        }
        print " </tr>   \n";
    }
    print "       </table>   \n";
    

}

function display_user_menu(){

    ?>

    <hr>
    <p><a href="member.php">Home</a>  |  <a href="add_bm_form.php">Add BM</a>  |  <a href="delete_bms.php">Delete BM</a>  |  <a href="change_passwd_form.php">Change password</a> </p>
    <p><a href="">Recommend URLs to me</a>  |  <a href="logout.php">Logout</a></p>

    <hr>

    <?php

}

function display_passwd_form(){

    ?>

    <h3>Change Password </h3>
    <br \>
    <form method="post" action="change_passwd.php">
        <p>Old Password: <input type="password" name="oldpword"></p>
        <p>New Password: <input type="password" name="newpword"></p>
        <p>Repeat New Password: <input type="password" name="cpword"></p>
        <input type="submit" value="Change Password">
    </form>

    <?php

}































































































