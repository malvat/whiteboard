<?php
    require('db_config.php');
    require('user.php');
    session_start();
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if(isset($_GET['branch']) || isset($_GET['cc'])) {
            $branch = $_GET['branch'];
            $ccId = $_GET['cc'];
            $sql = "select * from user inner join faculty on user.id = faculty.user_id where user.id = '$ccId'";
            if($results = $conn->query($sql)) {
                $rows = $results->fetch_assoc();
                $email = $rows['email'];
                $sql = "select * from roles where roles = 'student'";
                if($results = $conn->query($sql)) {
                    $rows = $results->fetch_assoc();
                    $roles_id = $rows['id'];
                    storeValidationNumber($user, $roles_id, $email, $ccId);
                } else {
                    echo $sql."some problem occured";
                }
                //sendVerficationMail($user, $rows['email']);
            } else {
                echo "sorry couldn't find such faculty, please try again later";
            }
            
        }
    }
       
    function storeValidationNumber($user, $roles_id, $email, $cc) {
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
                    sendVerficationMail($user, $email, $verification_code, $roles_id, $cc);
                } else {
                    echo "sql ma locha fari ";
                }
            }
        } else {
            echo $sql." aama locha chhe";
        }

    }

    function sendVerficationMail($user, $email, $verification_code, $roles_id, $cc) {
        $msg = "User needs Student role : \n";
        $msg.= "Name - ".$user->getFirstName();
        $msg.= " ".$user->getLastName()."\n";
        $msg.= "Email - ".$user->getEmail()."\n";
        $msg.= "Please click below link to provide such role : \n";
        $enrolment = $_GET['enrolment'];
        $msg.="http://localhost/projectv2/php/role_selection.php?user_id=".$user->getId()."&verification_code=".$verification_code."&roles_id=".$roles_id."&cc=".$cc."&enrolment=".$enrolment;
        $to = $email;
        $subject = "White Board - Student Role Access";
        $headers = "From: anim@whiteboard.com";
        mail($to, $subject, $msg, $headers);
        echo "Mail is sent \n";
        echo "waiting for verification";
    }
?>

<script type="text/javascript" src="jquery-3.3.1.js">
</script>

<div id='eg'>

</div>
<script type="text/javascript">
    function checking(){
        $.ajax({
            url: "admin_verification_check.php",
            data: "", 
            dataType: "text", 
            success: function(d) {
                $('#eg').text(d);
                if(d == 'done') {
                    window.location ="http://localhost/projectv2/php/user_check_roles.php";
                }
            }
        })
        console.log("it is working bro");
    }
    checking();
    setInterval(checking, 2000);



</script>