<?php
    require('db_config.php');
    require('user.php');
    
    session_start();
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $id = $user->getId();
        $sql = "select * from user_roles where user_id = '$id'";
        if($results = $conn->query($sql)) {
            if($results->num_rows > 0) {
                echo "done";
                
            } else {
                echo "you have still not got it";
            }
                
            
        } else {
            echo $sql." there was something wrong";
        }
    } else {
        echo "there is no session started";
    }
    
    
?>