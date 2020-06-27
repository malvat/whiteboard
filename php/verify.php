<?php
    include('db_config.php');
    if(isset($_GET['activation_code']) && isset($_GET['email'])) {
        $activation_code = $_GET['activation_code'];
        $email = $_GET['email'];
        $sql = "select * from user where email = '$email' and activation_code = '$activation_code' ";
        if($results = $conn->query($sql)) {
            if($results->num_rows > 0) {
                $sql = "update user set status = 1 where email = '$email'";
                if($conn->query($sql)) {
                    echo "successful";
                    header("Location: http://localhost/projectv2/php/user_login_page.php?error_msg=Verfication Successful.");
                } else {
                    echo "error update nahi hua";
                }
            } else {
                //error
                //redirect to registration page
                echo "error no similar found";
            }
        } else {
            //error
            //redirect to registration page
            echo "error";
        }
    } else {
        //error
        //redirect to login or registration page
        echo "error";
    }

?>