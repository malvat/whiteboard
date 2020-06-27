<?php
    require('db_config.php');
    require('user.php');
    session_start();
    $branch = $_GET['branch'];
    $sql = "select * from user inner join faculty on user.id = faculty.user_id where faculty.branch = '$branch'";
    echo "<br>";
    echo "Please select your class coordinator";
    echo "<br>";
    echo "<br>";
    echo "<select name='cc' id='cc'>";
    if($results = $conn->query($sql)) {
        if($results->num_rows <=0 ) {
            echo "<option> Some Problem Occured </option>";
        }
        while($row = $results->fetch_assoc()) {
            $fid = $row['user_id'];
            echo "<option value = '".$fid."'>".$row['firstname']." ".$row['lastname']."</option>";
        }
    }
    echo "</select>";
?>