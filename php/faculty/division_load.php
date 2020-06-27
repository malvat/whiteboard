<?php
    require('../faculty.php');
    require('../db_config.php');
    require('../user.php');
    session_start();
    if(!isset($_SESSION['user'])) {
        header("Location: http://localhost/projectv2/php/user_login_page.php");
    } else {
        $semester = $_GET['semester'];
        $faculty = $_SESSION['faculty'];
        $branch = $faculty->getBranch();
        $sql = "select * from class where semester = '$semester' and branch = '$branch'";
        if($results = $conn->query($sql)) {
            while($row = $results->fetch_assoc()) {
                $division = $row['division'];
                echo "<option value = '$division'>";
                echo $division;
                echo "</option>";
            }
        }
    }
?>