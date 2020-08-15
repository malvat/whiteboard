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
      <title>Faculty - Home</title>
      <!-- 	<link rel="shortcut icon" type="images/X" href="imgs\M.png"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
      <link rel="stylesheet" href="lib/bxslider/dist/jquery.bxslider.min.css">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/main.css ">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/responsive.css">
      
   </head>
   <body>
      <div class="side_panel">
         <div class="profile" style="text-align:center;width: 100%;">
            <img src="http://localhost/whiteboard/images/helly.jpg" class="img-circle" alt="profile photo" align="center" width="120" height="120">
            <h3 style="vertical-align:middle; margin:auto; width: 100%;"><?php echo $firstname; echo " " ;echo $lastname; ?></h3>
         </div>
         <!-- profile -->
         <div class="sidebar">
            <ul>
               <li><a href="#" class="active">Home</a></li>
               <li><a href="#">Academics</a></li>
               <li><a href="http://localhost/whiteboard/php/faculty/faculty_attendance.php">Attendance</a></li>
               <!-- if faculty is a time table coordinater they should be able to see the time table coordinator option -->
                <?php  
                  // check if the faculty has time table authorities 
                    $sql = "select * from roles where roles='timetable_coordinator'";
                    if($results=$conn->query($sql)) {
                        $row = $results->fetch_assoc();
                        $roles_id = $row['id'];
                        $sql = "select * from user_roles where user_id = '$user_id' and roles_id = '$roles_id'";
                        if($results = $conn->query($sql)) {
                            if($results->num_rows > 0) {
                                echo "<li><a href='http://localhost/whiteboard/php/faculty/faculty_timetable.php'>Time Table </a></li>";
                            }
                        }
                    }
                    $user = $_SESSION['user'];
                    $id = $user->getId();
                    $sql = "select * from class_coordinator where user_id = '$id'";
                    if($results = $conn->query($sql)) {
                        if($results->num_rows > 0) {
                            echo "<li> <a href='http://localhost/whiteboard/php/faculty/faculty_class.php'> Class </a> </li>";
                            $row = $results->fetch_assoc();
                            $_SESSION['class_id'] = $row['class_id'];
                        }
                    }
                ?>
               
               <li><a href="http://localhost/whiteboard/php/student/student_aboutus.php">About us</a></li>
               <li><a href="http://localhost/whiteboard/cuber/cuber.html">Cuber Game</a></li>
               <li><a href="http://localhost/whiteboard/shootdemsquares/index.html">Shoot Dem Squares</a></li>
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
               <ul>
                  <li>Advance Java</li>
                  <li>Dot Net</li>
                  <li>Web Technologies</li>
                  <li>DCDR</li>
                  <li>Lab DCDR</li>
               </ul>
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