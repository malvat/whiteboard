<?php
    require('user.php');
    require('db_config.php');
    session_start();
    if(isset($_SESSION['user'])) {
        //its okay
        $user = $_SESSION['user'];
        //fetching roles id
        if(isset($_GET['role'])) {
            $role = $_GET['role'];
            $sql = "select * from roles where roles = '$role'";
            if($results = $conn->query($sql)) {
                $row = $results->fetch_assoc();
                $roles_id = $row['id'];
                //we have everything we need to store
                storeValidationNumber($user, $roles_id);
            } else {
                echo "sql ma locha";
                //redirect
            }
        } else {
            echo "something went wrong .. ";
            //redirect
        }
        
    } else {
        echo "sorry you have to login again";
        //redirect
    }

    function storeValidationNumber($user, $roles_id) {
        global $conn;
        
        $verification_code = md5(rand());
        $id = $user->getId();
        
        $sql = "select * from roles_validation where user_id = '$id' and roles_id = '$roles_id'";
        if($results = $conn->query($sql)) {
            if($results->num_rows > 0) {
                echo "Already applied for verification";
            } else {
                //store it in database
                
                
                $sql = "insert into roles_validation(user_id, roles_id, verification_code) values ('$id', '$roles_id', '$verification_code')";
                if($conn->query($sql)) {
                    sendAdminMail($user, $verification_code, $roles_id);
                } else {
                    echo "sql ma locha fari ";
                }
            }
        } else {
            echo $sql." aama locha chhe";
        }
        
    }

    function sendAdminMail($user, $verification_code, $roles_id) {
        $msg = "User needs admin role : \n";
        $msg.= "Name - ".$user->getFirstName();
        $msg.= " ".$user->getLastName()."\n";
        $msg.= "Email - ".$user->getEmail()."\n";
        $msg.= "Please click below link to provide such role : \n";
        $email = "malvat.anim0@gmail.com";
        $msg.="http://localhost/whiteboard/php/role_selection.php?user_id=".$user->getId()."&verification_code=".$verification_code."&roles_id=".$roles_id;
        $to = $email;
        $subject = "White Board - Admin Role Access";
        $headers = "From: anim@whiteboard.com";
        mail($to, $subject, $msg, $headers);
        echo "Mail is sent \n";
        echo "waiting for verification";
    }
?>

<!--this code is new and can be removed if anything breaks-->

<div id="eg">
    sorry your code isn't working
</div>

<script type="text/javascript" src="jquery-3.3.1.js">
</script>

<script type="text/javascript">
    function checking(){
        $.ajax({
            url: "admin_verification_check.php",
            data: "", 
            dataType: "text", 
            success: function(d) {
                $('#eg').text(d);
                if(d == 'done') {
                    window.location ="http://localhost/whiteboard/php/user_check_roles.php";
                }
            }
        })
        console.log("it is working bro");
    }
    checking();
    setInterval(checking, 2000);



</script>