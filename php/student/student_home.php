<?php 
    require('../db_config.php');
    require('../user.php');
    require('../student.php');
    session_start();
    $user = $_SESSION['user'];
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Comatible" content="IE-edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Student - Home</title>
      <!-- 	<link rel="shortcut icon" type="images/X" href="imgs\M.png"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
      <link rel="stylesheet" href="lib/bxslider/dist/jquery.bxslider.min.css">
      <link rel="stylesheet" type="text/css" href="http://localhost/projectv2/css/main.css ">
      <link rel="stylesheet" type="text/css" href="http://localhost/projectv2/css/responsive.css">
     
   </head>
   <body>
      <div class="side_panel">
         <div class="profile" style="text-align:center;width: 100%;">
            <img src="http://localhost/projectv1/images/3.jpeg" class="img-circle" alt="Cinque Terre" align="center" width="100" height="100">
            <h3 style="vertical-align:middle; margin:auto; width: 100%;"><?php echo $firstname; echo " " ;echo $lastname; ?></h3>
         </div>
         <!-- profile -->
         <div class="sidebar">
            <ul>
               <li><a href="http://localhost/projectv1/php/student/student_profile.php" class="active">Home</a></li>
               <li><a href="http://localhost/projectv1/php/student/student_academics.php">Academics</a></li>
               <li><a href="http://localhost/projectv1/php/student/student_attendance.php">Attendance</a></li>
               <li><a href="http://localhost/projectv1/php/student/student_schedule.php">Schedule</a> </li>
               <li><a href="http://localhost/projectv1/php/student/student_aboutus.php">About us</a></li>
               <li><a href="http://localhost/projectv1/cuber/cuber.html">Cuber Game</a></li>
               <li><a href="http://localhost/projectv1/shootdemsquares/index.html">Shoot Dem Squares</a></li>
            </ul>
         </div>
         <!--  sidebar -->
      </div>
      <!-- sidenel-->
      <section class="canvas">
         <div class="Search">
            <!-- Search form -->
            <form class="form-inline">
               <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search">
            </form>
         </div>
         <!-- end Search form -->
         <div class="btn1">
            <form action="http://localhost/projectv2/php/user_logout.php" method="get">
               <input type="submit" class="but" value ="Log Out">
            </form>
         </div>
         <!-- btn -->
      </section>
      <!-- canavs -->
      <section class="canvas fl-left">
         <!-- main section -->
         <div class="work1">
            <div class="news">
               <h3>News</h3>
               <ul>
                  <li>6th august mid semester commencing</li>
                  <li>16th october aduition for junoon 2018</li>
               </ul>
            </div>
            <!--  news -->
            <div class="Attendance">
               <!-- baaki -->
               <h3>
                  Attendance
               </h3>
            </div>
            <div class="Schedule">
               <h3>Schedule</h3>
                <?php
                
                    $student = $_SESSION['student'];
                    $class_id = $student->getClassId();
                    $sql = "select * from class where id = '$class_id'";
                    if($results = $conn->query($sql)) {
                        
                        if($rows = $results->fetch_assoc()) {
                            $semester = $rows['semester'];
                            $division = $rows['division'];
                            $day = date('1');
                            $day -= 1;
                            $sql = "select * from (select schedule.*, subject.name, subject.semester as sem from schedule inner join subject on subject.id = schedule.subject_id) as t where semester = '$semester' and division = '$division' and day = '$day'";
                            if($results = $conn->query($sql)) {
                                echo "<ul>";
                                while($row = $results->fetch_assoc()) {
                                    echo "<li>";
                                    echo $row['name'];
                                    echo "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "there was some error";
                            }
                        }
                    } else {
                        echo "class maj problem chhe";
                    }
                ?>
<!--
               <ul>
                  <li>Advance Java</li>
                  <li>Dot Net</li>
                  <li>Web Technologies</li>
                  <li>DCDR</li>
                  <li>Lab DCDR</li>
               </ul>
-->
            </div>
            <!-- schedule -->
            <div class="Progress">
               <!--   baaki -->
               <h3>
                  Progress
               </h3>
            </div>
            <div class="pendingwork">
               <h3>Pending Work</h3>
               <ul>
                  <li>26th august: Submit AJ: Assignmnet 6</li>
                  <li>30th august: Submit WT: Assignmnet 4</li>
                  <li>30th august: DCDR:Clear module 7</li>
               </ul>
            </div>
         </div>
      </section>
      <!-- endofsection -->
      <!-- /js-quary -->
      <script src="js/jquery.min.js"></script>
      <!-- /js -->
      <script src="lib/bxslider/dist/jquery.bxslider.min.js"></script>
      <!-- main.js -->
      <script src="js/min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCco29pL2yRek6xQIaT9DxpYgGfbx35Mps&callback=myMap"></script>
   </body>
</html>