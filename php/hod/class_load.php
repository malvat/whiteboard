<?php
    require('../db_config.php');
    require('../Hod.php');
    session_start();
    if(isset($_SESSION['user']) && isset($_SESSION['hod'])) {
        $hod = $_SESSION['hod'];
        $branch = $hod->getBranch();
        $semester = $_GET['semester'];
        $sql = "select * from class where branch = '$branch' and semester = '$semester'";
        if($results = $conn->query($sql)) {
            while($row = $results->fetch_assoc()) {
                $id = $row['id'];
                echo "<option value='$id'>";
                echo $row['semester'];
                echo " ";
                echo $row['branch'];
                echo " ";
                echo $row['division'];
                echo "</option>";
            }
        }
    } else {
        echo "there was some error";
    }
?>