<?php 
    require('../db_config.php');
    require('../user.php');
    require('../faculty.php');
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
      <title>Faculty - Attendance</title>
      <!-- 	<link rel="shortcut icon" type="images/X" href="imgs\M.png"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
      <link rel="stylesheet" href="lib/bxslider/dist/jquery.bxslider.min.css">
      <link rel="stylesheet" type="text/css" href="http://localhost/projectv1/css/main.css ">
      <link rel="stylesheet" type="text/css" href="http://localhost/projectv1/css/responsive.css">
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
               <li><a href="http://localhost/projectv2/php/faculty/faculty_home.php">Home</a></li>
               <li><a href="#">Academics</a></li>
               <li><a href="#" class="active">Attendance</a></li>
                <?php 
                    
                    $sql = "select * from roles where roles='timetable_coordinator'";
                    if($results=$conn->query($sql)) {
                        $row = $results->fetch_assoc();
                        $roles_id = $row['id'];
                        
                        $sql = "select * from user_roles where user_id = '$user_id' and roles_id = '$roles_id'";
                        if($results = $conn->query($sql)) {
                            if($results->num_rows > 0) {
                                echo "<li><a href='http://localhost/projectv2/php/faculty/faculty_timetable.php'>Time Table </a></li>";
                            }
                        }
                    }
                ?>
               
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
           
            <div class="news" id="container" style="width:80%; height:70%; overflow-y: scroll;">
                <h3>
                    Please select class and subject
                </h3>
               <?php
                    $user = $_SESSION['user'];
                    $user_id = $user->getId();
                    $sql = "select distinct semester, name, sid, division from (select schedule.*, subject.semester as sem, subject.name, subject.id as sid from schedule inner join subject on schedule.subject_id = subject.id where user_id = '$user_id') as ss";
                    if($results = $conn->query($sql)) {
                        echo "<select name=class id=class>";
                        while($row = $results->fetch_assoc()) {
                            $sem = $row['semester'];
                            $div = $row['division'];
                            $sid = $row['sid'];
                            echo "<option value=".$sem.$div.$sid.">";
                            echo $sem."-";
                            echo $div."-";
                            echo $row['name'];
                            echo "</option>";                            
                        } echo "</select>";
                    } else {
                        echo "some problem";
                    }
                ?>
                <br>
                <br>
                <input name="date_picker" type='date' id='dd' data-date-inline-picker=true/>
                <br>
                <br>
                <button onclick="onProceedClick()">Proceed</button>
            </div>
            

         
      </section>
       <script type="text/javascript" src="../jquery-3.3.1.js"> </script>
        <script type="text/javascript">
                document.getElementById('dd').valueAsDate = new Date();
                var onProceedClick = function(){
                    var c = document.getElementById('class').value;
                    var semester = c[0];
                    var division = c[1];
                    var s = c[2];
                    var date_picker = document.getElementById('dd').value;
                    var container = document.getElementById('container');
                    container.innerHTML = "";
                    $.ajax({
                        url: "attendance_list_load.php",
                        type: "post",
                        data: ({"semester":semester, "division":division, "s":s, "date_picker": date_picker}),
                        dataType: "text",
                        success: function(data) {
                            var s = "<h3> Select Present Students </h3>";
                            s+= data;
                            container.innerHTML = s;
                        }
                    })
                }
            </script>
      <!-- endofsection -->
      
   </body>
</html>