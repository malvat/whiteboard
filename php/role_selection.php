<?php
    include('db_config.php');
    if(isset($_GET['verification_code']) && isset($_GET['roles_id']) && isset($_GET['user_id'])) {
        $verification_code = $_GET['verification_code'];
        $roles_id = $_GET['roles_id'];
        $user_id = $_GET['user_id'];
        
        $sql = "select * from user_roles where user_id = '$user_id'";
        if($results = $conn->query($sql)) {
            if($results -> num_rows > 0) {
                echo "User currently have a role";
            } else {
                updateRolesTable($user_id, $roles_id, $verification_code);
            }
        } else {
            echo $sql."something is wrong";
        }
    } else {
        echo "kuchh locha hai";
    }

    function updateRolesTable($user_id, $roles_id, $verification_code) {
        global $conn;
        $sql = "select * from roles_validation where user_id = '$user_id' and roles_id = '$roles_id' and verification_code = '$verification_code'";
        if($conn->query($sql)) {
            $sql = "insert into user_roles(user_id, roles_id) values('$user_id', '$roles_id')";
            if($conn->query($sql)) {
                echo "done";
                checkRole($roles_id, $user_id);
            } else {
                echo "not done";
            }
        } else {
            echo "nai barabar";
        }
    }

    function checkRole($roles_id, $user_id) {
        global $conn;
        $sql = "select * from roles where id = '$roles_id'";
        if($results = $conn->query($sql)) {
            $row = $results->fetch_assoc();
            if($row['roles']=='hod') {
                //getting essentials for hod and then storing to hod table
                $branch = $_GET['branch'];
                insertHodDetails($user_id, $branch);
            } else if($row['roles']=='faculty') {
                //getting essentials for faculty and then storing to faculty
                $branch = $_GET['branch'];
                insertFacultyDetails($user_id, $branch);
            } else if($row['roles']=='student') {
                //getting essentials for student and then storing to student table
                $cc = $_GET['cc'];
                //getting class id from class coordinator table
                $sql = "select * from (select class_coordinator.*, faculty.branch from class_coordinator inner join faculty on faculty.user_id = class_coordinator.user_id) as t where user_id = '$cc'";
                if($results = $conn->query($sql)) {
                    if($row = $results->fetch_assoc()) {
                        $class = $row['class_id'];
                        $branch = $row['branch'];
                        $enrolment = $_GET['enrolment'];
                        insertStudentDetails($user_id, $branch, $enrolment, $cc, $class);        
                    }
                }
                
            }
        }
    }
    function insertHodDetails($user_id, $branch) {
        global $conn;
        $sql = "insert into hod(user_id, branch) values('$user_id', '$branch')";
        if($conn->query($sql)) {
            
        }
    }
    
    function insertFacultyDetails($user_id, $branch) {
        global $conn;
        $sql = "insert into faculty(user_id, branch) values('$user_id', '$branch')";
        if($conn->query($sql)) {
            
        }
    }

    function insertStudentDetails($user_id, $branch, $enrolment, $cc, $class) {
        global $conn;
        $sql = "insert into student(user_id, branch, enrolment, cc_id, class_id) values('$user_id', '$branch', '$enrolment', '$cc', '$class')";
        if($conn->query($sql)) {
            
        }
    }
?>