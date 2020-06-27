<?php
    include('User.php');
    session_start();
    if(isset($_SESSION['user'])) {
        session_destroy();
        echo "logged out";
        header("Location: http://localhost/projectv2/php/user_login_page.php");
    } else {
        echo "there were no session";
        //redirect;
    }
?>