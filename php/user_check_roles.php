<?php
    include('User.php');
    require('db_config.php');
    require('hod.php');
    require('faculty.php');
    require('student.php');
    session_start();
    if(isset($_SESSION['user'])) {
        $email = $_SESSION['user']->getEmail();
        $sql = "select * from user inner join user_roles on user.id = user_roles.user_id inner join roles on user_roles.roles_id = roles.id where user.email = '$email'";
        if($results = $conn->query($sql)) {
            if($results->num_rows > 0) {
                $row = $results->fetch_assoc();
                echo $row['roles'];  
                echo '<br><a href="http://localhost/whiteboard/php/user_logout.php"> Logout </a>';
                if($row['roles'] == 'admin') {
                    header("location: http://localhost/whiteboard/php/admin/admin_home.php");
                } else if($row['roles'] == 'hod') {
                   
                    $id = $_SESSION['user']->getId();
                    $sql = "select * from hod where user_id ='$id'";
                    if($results=$conn->query($sql)) {
                        $row = $results->fetch_assoc();
                        $id = $row['id'];
                        $branch = $row['branch'];
                        $hod = new Hod($id, $branch);
                        $_SESSION['hod'] = $hod;
                    }
                    header("location: http://localhost/whiteboard/php/hod/hod_home.php");   
                    
                } else if($row['roles'] == 'faculty') {
                    $id = $_SESSION['user']->getId();
                    $sql = "select * from faculty where user_id ='$id'";
                    if($results=$conn->query($sql)) {
                        $row = $results->fetch_assoc();
                        $id = $row['id'];
                        $branch = $row['branch'];
                        $faculty = new Faculty($id, $branch);
                        $_SESSION['faculty'] = $faculty;
                    }
                    header("location: http://localhost/whiteboard/php/faculty/faculty_home.php");
                } else if($row['roles'] == 'student') {
                    $id = $_SESSION['user']->getId();
                    $sql = "select * from student where user_id ='$id'";
                    if($results=$conn->query($sql)) {
                        $row = $results->fetch_assoc();
                        $cc_id = $row['cc_id'];
                        $branch = $row['branch'];
                        $class_id = $row['class_id'];
                        $enrolment = $row['enrolment'];
                        $student = new Student($cc_id, $branch, $enrolment, $class_id);
                        $_SESSION['student'] = $student;
                    }
                    header("location: http://localhost/whiteboard/php/student/student_home.php");
                }
                //after getting roles redirect to appropriate profile or dashboard
            } else {
                echo "please select role";
                //redirecting to user profile //that's general profile
                header("location: http://localhost/whiteboard/php/user_select_roles_page.php");
            }
            
        } else {
            echo "something went wrong with the sql";
        }
    } else {
        echo "login to karle bhai";
    }
?>