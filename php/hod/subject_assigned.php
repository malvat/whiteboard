<html>

<?php
    require('../db_config.php');
    require('../hod.php');
    require('../user.php');
    session_start();
    $subject = $_GET['subject'];
    $faculty = $_GET['faculty'];
    $semester = $_GET['semester'];
    $class_id = $_GET['class'];
    $hod = $_SESSION['hod'];
    $branch = $hod->getBranch();
    
    $sql = "select * from class where id = '$class_id'";
    if($results = $conn->query($sql)) {
        $row = $results->fetch_assoc();
        $division = $row['division'];
        $sql = "select * from assigned_subject where faculty_id = '$faculty' and subject_id = '$subject' and division = '$division'";
        if($results = $conn->query($sql)) {
            if($results->num_rows>0) {
                //faculty is assigned subject already
                $msg="subject is already assigned to the faculty";
                echo "<script type=text/javascript>  alert('$msg'); ";
                $url = "http://localhost/projectv2/php/hod/hod_assign_subject.php";
                echo "location.href = '$url'; </script>";
            } else {
                //if the faculty is not assigned that subject 
                // then only assign it
                $sql = "insert into assigned_subject(faculty_id, subject_id, semester, branch, division) values('$faculty', '$subject', '$semester', '$branch', '$division')";
                if($conn->query($sql)) {
                    $msg="subject was assigned";
                    echo "<script type=text/javascript>  alert('$msg'); ";
                    $url = "http://localhost/projectv2/php/hod/hod_assign_subject.php";
                    echo "location.href = '$url'; </script>";


                } else {
                    header("location: http://localhost/projectv2/php/hod/hod_assign_subject.php");
                }
            }
        } else {
            echo "there was some error with database";
        }
        
        
    }
?>
</html>