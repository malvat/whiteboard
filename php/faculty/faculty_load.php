
<?php
    require('../faculty.php');
    require('../db_config.php');
    require('../user.php');
    session_start();
    if(!isset($_SESSION['user'])) {
        header("Location: http://localhost/projectv2/php/user_login_page.php");
    } else {
        $semester = $_GET['semester'];
        $division = $_GET['division'];
        $subject = $_GET['subject'];
        $faculty = $_SESSION['faculty'];
        $branch = $faculty->getBranch();
        $sql = "select * from (select subject.*, assigned_subject.semester as sem, user.id as uid, user.firstname, user.lastname from assigned_subject inner join subject on assigned_subject.subject_id = subject.id inner join user on assigned_subject.faculty_id = user.id) as ss where ss.sem = '$semester' and branch = '$branch' and id = '$subject';";
        if($results = $conn->query($sql)) {
            while($row = $results->fetch_assoc()) {
                $name = $row['firstname'][0]." ".$row['lastname'][0];
                $full_name = $row['firstname']." ".$row['lastname'];
                $id = $row['uid'];
                echo "<option value = '$id' title='$full_name'>";
                echo $name;
                echo "</option>";
            }
        }
    }
?>
