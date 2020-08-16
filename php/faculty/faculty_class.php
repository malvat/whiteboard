<?php 
    require('../db_config.php');
    require('../user.php');
    session_start();
    $user = $_SESSION['user'];
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $user_id = $user->getId();

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Comatible" content="IE-edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Faculty - Time Table</title>
      <!-- 	<link rel="shortcut icon" type="images/X" href="imgs\M.png"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/main.css ">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/responsive.css">
      <link rel="stylesheet" href="./../../css/class.css">
       
   </head>
   <body>
      <div class="side_panel">
         <div class="profile" style="text-align:center;width: 100%;">
            <img src="http://localhost/whiteboard/images/helly.jpg" class="img-circle" alt="profile photo" align="center" width="100" height="100">
            <h3 style="vertical-align:middle; margin:auto; width: 100%;"><?php echo $firstname; echo " " ;echo $lastname; ?></h3>
         </div>
         <!-- profile -->
         <div class="sidebar">
            <ul>
               <li><a href="http://localhost/whiteboard/php/faculty/faculty_home.php" >Home</a></li>
               <li><a href="#">Academics</a></li>
               <li><a href="http://localhost/whiteboard/php/faculty/faculty_attendance.php">Attendance</a></li>
                <?php 
                    
                    $sql = "select * from roles where roles='timetable_coordinator'";
                    if($results=$conn->query($sql)) {
                        $row = $results->fetch_assoc();
                        $roles_id = $row['id'];
                        
                        $sql = "select * from user_roles where user_id = '$user_id' and roles_id = '$roles_id'";
                        if($results = $conn->query($sql)) {
                            if($results->num_rows > 0) {
                                echo "<li><a href='http://localhost/whiteboard/php/faculty/faculty_timetable.php' class='active'>Time Table </a></li>";
                            } else {
                                header("Location:http://localhost/whiteboard/php/faculty/faculty_home.php");
                            }
                        }
                    }
                ?>
               
               <li><a href="http://localhost/whiteboard/php/student/student_aboutus.php">About us</a></li>
            </ul>
         </div>
         <!--  sidebar -->
      </div>
      <!-- sidenel-->
      <section class="canvas">
         <!-- end Search form -->
         <div class="btn1">
            <form action="http://localhost/whiteboard/php/user_logout.php" method="get">
               <input type="submit" class="but" value ="Log Out">
            </form>
         </div>
         <!-- btn -->
      </section>
      <!-- canavs -->
      <section class="canvas fl-left">
         <!-- main section -->
         <div class="work1">
            <div class="news" style="width:80%; height:70%;" id="table">
               <h3>
                  Student List
               </h3>
               <div class="table-container">
                <?php
                  $class_id = " ";
                  if(isset($_SESSION['class_id'])) {
                     $class_id = $_SESSION['class_id'];
                  }
                  // find students with class id
                  $sql = "select * from student inner join user on user.id = student.user_id where class_id = '$class_id'";
                  // print those results in a table
                  if($results = $conn->query($sql)) {
                     echo "<table>";
                     echo "<tr>";
                     echo "<th> Enrolment </th>";
                     echo "<th> First Name </th>";
                     echo "<th> Last Name </th>";
                     echo "<th> Branch </th>";
                     echo "</tr>";
                     while($row = $results->fetch_assoc()) {
                           echo "<tr>";
                           echo "<td>".$row['enrolment']."</td>";
                           echo "<td>".$row['firstname']."</td>";
                           echo "<td>".$row['lastname']."</td>";
                           echo "<td>".$row['branch']."</td>";
                           echo "</tr>";
                     }
                     echo "</table>";
                  }
                ?>
                </div>
                <!-- table container ended  -->
            </div>
          </div>
      </section>
   </body>
</html>