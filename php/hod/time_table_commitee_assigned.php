<html>

<?php
    require('../db_config.php');
    require('../hod.php');
    require('../user.php');
    session_start();

    $hod = $_SESSION['hod'];
    $branch = $hod->getBranch();
    $sql = "select * from roles where roles = 'timetable_coordinator'";
    if($results = $conn->query($sql)) {
        $row = $results->fetch_assoc();
        $roles_id = $row['id'];
        $faculty_id = $_GET['faculty'];
        $sql = "select * from user_roles where user_id = '$faculty_id' and roles_id='$roles_id'";
        $flag = 0;
        if($results = $conn->query($sql)) {
            if($results->num_rows>0) {
                $flag = 1;
                $msg = "faculty has been already given the role";
                echo "<script type=text/javascript>  alert('$msg'); ";
                $url = "http://localhost/projectv2/php/hod/hod_time_table.php";
                echo "location.href = '$url'; </script>";
            } else{
                $flag = 0;
            }
        } else {
            echo "there was some issue";
        }
        
        if($flag==0) {
            $sql = "insert into user_roles(user_id, roles_id) values ('$faculty_id', '$roles_id')";
            if($conn->query($sql)) {
                $msg="TT role assigned";
                echo "<script type=text/javascript>  alert('$msg'); ";
                $url = "http://localhost/projectv2/php/hod/hod_time_table.php";
                echo "location.href = '$url'; </script>";
            } else {
                header("location: http://localhost/projectv2/php/hod/hod_time_table.php");
            }    
        }
        
    }
    
    
   
?>
</html>