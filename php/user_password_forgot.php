<?php
    include('db_config.php');
    $email = $_POST['email'];
    
    //check if email exists or not
    
    //if exists
    //check for blocked time
    //if blocked return with threatening message
    //check there is issued or not
    //if issued then check for 15 mins 
    //if yes return 
    //else remove that entry do it for next entry 
    //if no entry remaining or no entry found 
    //generate random number and store md5 of that and mail the user with appropriate link
    
    
    if(!isset($email)) {
        //redirect
    }
    
    $user_details = null;
    if(isEmailExists($email)) {
        $results = getForgotDetails($email);
        if(checkIssuedTimeClash($results)) {
            echo "Please try again in 15 mins";
        } else {
            //storing time stamps and other such details in database
            $user_array = $user_details->fetch_assoc();
            $user_id = $user_array['id'];
            date_default_timezone_set("Asia/Kolkata");
            $issued_time = date("y-m-d H:i:s");
            $code = md5(rand());
            $sql = "insert into password_forgot(user_id, issued_time, verification_code) values
            ('$user_id', '$issued_time', '$code')";
            if($conn->query($sql)) {
                sendVerificationMail($code, $email);
            } else {
                //sorry nothing is going accordingly 
            }
            
        }
    } else {
        echo "We do not have any such user";
    }

    $results = getForgotDetails("malvat.anim0@gmail.com");
//    while($row = $results->fetch_assoc()) {
//        echo $row['issued_time'];
//    }
    echo checkIssuedTimeClash($results);

    function isEmailExists($email) {
        $sql = "select * from user where email = '$email'";
        global $conn;
        global $user_details;
        if($user_details = $conn->query($sql)) {
            if($user_details->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            echo "query couldn't run";
            return 0;
        }

    }

    function getForgotDetails($email) {
        $sql = "select * from user inner join password_forgot on user.id = password_forgot.user_id";
        global $conn;
        if($results = $conn->query($sql)) {
            return $results;
        } else {
            return null;
        }
    }

    function checkIssuedTimeClash($results) {
        date_default_timezone_set("Asia/Kolkata");
        global $conn;
        while($row = $results->fetch_assoc()) {
            
            $start = date_create($row['issued_time']);
            $end = date_create();
            $d = date_diff($end, $start);                      
            $minutes = $d->days * 24 * 60;      
            $minutes += $d->h * 60;
            $minutes += $d->i;
            
            if($minutes > 15) {
                $sql = "delete from password_forgot where user_id = '$row[user_id]'";
                if($conn->query($sql)) {
                    //echo "done";
                } else {
                    //echo "na thayu";
                } 
                echo " vadhaar chhe";
                return 0;
            } else {
                return 1;
            }    
        }
        return 0;
    }

    function sendVerificationMail($code, $email) {
        $msg = "click below link for resetting: \n";
        $msg.= "http://localhost/projectv2/php/user_password_reset_page.php?verification_code=".$code."&email=".$email;
        $to = $email;
        $subject = "Reset You Password";
        $headers = "From: anim@whiteboard.com";
        mail($to, $subject, $msg, $headers);
    }
?>