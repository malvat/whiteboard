<?php
    require('../db_config.php');
    require('../user.php');
    session_start();
    $semester = $_POST['semester'];
    $division = $_POST['division'];
    $sid = $_POST['s'];
    $date_picker = $_POST['date_picker'];
    
    $sql = "select firstname, lastname, enrolment, student.user_id as sid from student inner join user on user.id = student.user_id inner join class on student.class_id = class.id where semester = '$semester' and division = '$division'";
    echo "<form action='http://localhost/whiteboard/php/faculty/attendance_upload.php' method='post'>";
    if($results = $conn->query($sql)) {
        while($row = $results->fetch_assoc()) {
            $id = $row['sid'];
            echo "<input type='hidden' name='semester' value='$semester'>";
            echo "<input type='hidden' name='division' value='$division'>";
            echo "<input type='hidden' name='date_picker' value='$date_picker'>";
            echo "<input type='hidden' name='subject_id' value='$sid'>";


            
            echo "<label> <input type=checkbox name='$id'> ";
            echo $row['enrolment'];
            echo " ";
            echo $row['firstname'];
            echo " ";
            echo $row['lastname'];
            echo "</label>";
            echo "<br>";
        }
        echo "<input type=submit value=submit>";
        echo "</form>";
    }
    
?>