<?php
    require('../db_config.php');
    $id = $_GET['id'];
    $sql = "delete from assigned_subject where id = '$id'";
    if($conn->query($sql)) {
        
    } else {
        echo "<script> alert('sorry there was some error') </script>";
    }
    $sql = "select user.*, assigned_subject.semester, assigned_subject.branch, assigned_subject.id as asid, assigned_subject.division from assigned_subject inner join user on user.id = assigned_subject.faculty_id";
    if($results = $conn->query($sql)) {
        echo "<table>";
        while($row = $results->fetch_assoc()) {
            echo "<tr>";

            echo "<td>";
            echo "<button value=".$row['asid']." onclick='onDeleteClick(event)'> delete </button>";
            echo "</td>";

            echo "<td>";
            echo $row['firstname'];
            echo " ";
            echo $row['lastname'];

            echo "</td>";

            echo "<td>";
            echo $row['semester'];
            echo "</td>";

            echo "<td>";
            echo $row['branch'];
            echo "</td>";

            echo "<td>";
            echo $row['division'];
            echo "</td>";

            echo "</tr>";
        }
        echo "</table>";
    }
?>