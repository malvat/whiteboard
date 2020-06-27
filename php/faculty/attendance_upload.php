<?php
    require('../user.php');
    require('../db_config.php');
    require('../faculty.php');
    session_start();
    
    if(!isset($_SESSION['user']) || !isset($_SESSION['faculty'])) {
        header("Location: http://localhost/whiteboard/php/user_login_page.php");
    } else {
        $date = $_POST['date_picker'];
        echo $date;
        $semester = $_POST['semester'];
        $division = $_POST['division'];
        $sid = $_POST['subject_id'];
        echo $sid;
        $sql = "select firstname, lastname, enrolment, student.user_id as sid from student inner join user on user.id = student.user_id inner join class on student.class_id = class.id where semester = '$semester' and division = '$division'";
        if($results = $conn->query($sql)) {
            $sql = "";
            while($row = $results->fetch_assoc()) {
                $id = $row['sid'];
                if(isset($_POST[$id])) {
                    $sql.= "insert into attendance(date, user_id, present, subject_id) values ('$date', $id, TRUE, '$sid');";
                } else {
                    $sql.= "insert into attendance(date, user_id, present, subject_id) values ('$date', $id, FALSE , '$sid');";
                }
            }
            if($conn->multi_query($sql)) {
                echo "done";
            }
        }
    }
?>