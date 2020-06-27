<?php
    require('../db_config.php');
    require('../user.php');
    require('../faculty.php');
    session_start();
    if(!isset($_SESSION['faculty'])) {
        header("location: http://localhost/whiteboard/php/user_login.page.php");
    }
    echo $_GET['semester'];
    echo $_GET['division'];

    $semester = $_GET['semester'];
    $division = $_GET['division'];
    $branch = $_SESSION['faculty']->getBranch();
    $sql ="";
    for($j=1;$j<12;$j+=2) {
        $day = floor($j/2);
        for($i = 1;$i <= 6; $i++) {
            $lecture = $i;
            
            $subject_id = $_POST['s'.$i.$j];
            
            $user_id = $_POST['s'.$i.($j+1)];
            $sql.= "insert into schedule(user_id, subject_id, lecture, day, semester, division, branch) value('$user_id', '$subject_id', '$lecture', '$day','$semester', '$division', '$branch');";
        }  
        
    }
    if($conn->multi_query($sql)) {
        echo "done";
    } else {
        echo $sql." there was some problem";
    }
    
?>