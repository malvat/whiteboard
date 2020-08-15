<?php
    require('../db_config.php');
    require('../user.php');
    session_start();
    $semester = $_POST['semester'];
    $division = $_POST['division'];
    $sid = $_POST['s'];
    $date_picker = $_POST['date_picker'];
    
    $sql = "select firstname, lastname, enrolment, student.user_id as sid from student inner join user on user.id = student.user_id inner join class on student.class_id = class.id where semester = '$semester' and division = '$division'";
    echo "<div class='attendance-form'>";
    echo "<form action='http://localhost/whiteboard/php/faculty/attendance_upload.php' method='post'>";
    echo "<table>";
    echo "<tr> <th> Present </th> <th> Enrolment </th> <th> First Name </th> <th> Last Name </th>";
    if($results = $conn->query($sql)) {
        while($row = $results->fetch_assoc()) {
            $id = $row['sid'];
            echo "<input type='hidden' name='semester' value='$semester'>";
            echo "<input type='hidden' name='division' value='$division'>";
            echo "<input type='hidden' name='date_picker' value='$date_picker'>";
            echo "<input type='hidden' name='subject_id' value='$sid'>";
            echo "<label for='$id'>";
            echo "<tr>";
            echo "<td>";
            echo "<input id='$id' type=checkbox name='$id'>";
            echo "</td>";
            echo "<td>";
            echo $row['enrolment'];
            echo "</td>";
            // first name 
            echo "<td>";
            echo $row['firstname'];
            echo "</td>";
            // last name
            echo "<td>";
            echo $row['lastname'];
            echo "</td>";

            echo "</tr>";
            echo "</label>";
        }
        echo "<tr>";
        echo "<td colspan=4>";
        echo "<input class='proceed-btn' type=submit value=submit>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</form>";
        echo "</div>";
    }
    
?>