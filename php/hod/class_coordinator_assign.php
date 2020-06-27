<?php   
    require('../db_config.php');
    //do something to authenticate
    if(!isset($_GET['faculty']) && !isset($_GET['class'])) {
        header("Location: http://localhost/projectv2/php/hod/hod_home.php");
    } else {
        $user_id = $_GET['faculty'];
        $class_id = $_GET['class'];
        $sql = "select * from class_coordinator where user_id = '$user_id'";
        if($results = $conn->query($sql)) {
            if($results->num_rows>0) {
               $msg="Faculty already has class assigned";
                echo "<script type=text/javascript>  alert('$msg'); ";
                $url = "http://localhost/projectv2/php/hod/hod_class_coordinator.php";
                echo "location.href = '$url'; </script>"; 
            } else {
                $sql = "insert into class_coordinator(user_id, class_id) values('$user_id', '$class_id')";
                if($conn->query($sql)) {
                    $msg="Class was assigned";
                    echo "<script type=text/javascript>  alert('$msg'); ";
                    $url = "http://localhost/projectv2/php/hod/hod_class_coordinator.php";
                    echo "location.href = '$url'; </script>";
                } else {
                    echo "kaink locho";
                }
            }
        } else {
            header("Location: http://localhost/projectv2/php/hod/hod_class_coordinator.php");
        }
        
    }
?>