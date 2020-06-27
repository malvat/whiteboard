<?php
    require('user_password_forgot.php');
    require('db_config');
    $code = $_GET['verification_code'];
    $email = $_GET['email'];
    if(!isset($email) || !isset($code)) {
        //redirect
    } else {
        //check if email id exists
        if(isEmailExists($email)) {
            //check verification code
            $sql = "select * from user inner join password_forgot on user.id = password_forgot.user_id where email = '$email' and verification_code = '$code'";
            if($results = $conn->query($sql)) {
                if($results->num_rows > 0) {
                    //display the page
                    header("Location: http://localhost/projectv2/php/user_password_reset_page.php?verification_code='$code'&email='$email'");
                } else {
                    //redirect
                    echo "evu koi verificaiton code nathi";
                }
            } else {
                //sorry there was error
                echo "dbms ma problem chhe";
            }
        } else {
            //sorry 
            //redirect
            echo "email natu";
        }
    }

    
?>