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
      
      <link rel="stylesheet" type="text/css" href="http://localhost/projectv1/css/main.css ">
      <link rel="stylesheet" type="text/css" href="http://localhost/projectv1/css/responsive.css">
       
   </head>
   <body>
      <div class="side_panel">
         <div class="profile" style="text-align:center;width: 100%;">
            <img src="http://localhost/projectv1/images/3.jpeg" class="img-circle" alt="Cinque Terre" align="center" width="100" height="100">
            <h3 style="vertical-align:middle; margin:auto; width: 100%;"><?php echo $firstname;
                                                                        echo " ";
                                                                        echo $lastname; ?></h3>
         </div>
         <!-- profile -->
         <div class="sidebar">
            <ul>
               <li><a href="http://localhost/projectv2/php/faculty/faculty_home.php" >Home</a></li>
               <li><a href="#">Academics</a></li>
               <li><a href="http://localhost/projectv2/php/faculty/faculty_attendance.php">Attendance</a></li>
                <?php 

                $sql = "select * from roles where roles='timetable_coordinator'";
                if ($results = $conn->query($sql)) {
                    $row = $results->fetch_assoc();
                    $roles_id = $row['id'];

                    $sql = "select * from user_roles where user_id = '$user_id' and roles_id = '$roles_id'";
                    if ($results = $conn->query($sql)) {
                        if ($results->num_rows > 0) {
                            echo "<li><a href='http://localhost/projectv2/php/faculty/faculty_timetable.php' class='active'>Time Table </a></li>";
                        } else {
                            header("Location:http://localhost/projectv2/php/faculty/faculty_home.php");
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
         <div class="work1">
            <div class="news" style="width:80%; height:70%;" id="table">
                <br>
                <br>
                <br>
                <br>
                

                <form>
                    <h1 style="font-size: 24px;">
                        Please select semester and division
                    </h1>
                    <br>
                    <select id="semester" name="semester" onchange="onSemesterChange()">
                        <script type="text/javascript">
                            var semester = document.getElementById('semester');
                            for(var i = 0; i<8; i++) {
                                semester.innerHTML+= "<option value ="+(i+1)+"> "+(i+1)+"    </option>";
                            }


                        </script>                    
                    </select>

                    <select id="division" name="division">

                    </select>
                    <script src="../jquery-3.3.1.js"></script>

                    <script type="text/javascript">
                        var semester = "";
                        var division = "";
                        onSemesterChange();
                        function onSemesterChange() {
                            var sem = document.getElementById('semester').value;
                            
                            
                            $.ajax({
                                url: "division_load.php",
                                data: ({"semester": sem}),
                                dataType: "text",
                                success: function(data) {
                                    $('#division').html(data);
                                }
                            })
                        }
                    </script>
                    <br>
                    <br>
                    <button onclick="onClickProceed()"> Proceed</button>
                </form>
            </div>
          </div>
      </section>
      
       <script>
            function onClickProceed() {
                var sem = document.getElementById('semester').value;
                var div = document.getElementById('division').value;
                semester = sem;
                division = div;
                var table = document.getElementById('table');
                table.innerHTML = " ";
                var t = " ";
                t+="<form action='http://localhost/projectv2/php/faculty/store_timetable.php?semester="+sem+"&division="+div+"' method='POST' style='margin-left:10%; margin-top:5%;'>";
                t += "<table>";
                for(var i = 0; i <= 6; i++) {
                    t += "<tr style='border: 1px solid black;'>";
                    var days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    var dayCounter = 0;
                    for(var j = 1; j <= 12; j++) {
                        if(i == 0 && dayCounter < 6) {
                            t += "<td colspan=2 style='border: 1px solid black; min-width:50px;' id=t"+ i + j+">" +days[dayCounter]+" </td>";    
                            dayCounter++;
                        } else if(i!=0) {
                            t += "<td style='border: 1px solid black; padding: 5px;' id=t"+ i + j+">  </td>";    
                        }
                        
                    }
                    t += "</tr>";

                }
                t += "</table> <br> <input type='submit' value='submit' style='margin-left:70%;'/> </form>";
                table.innerHTML = t;   
                subjectLoad(semester);
                
            }
           var subjectNames = "";
           function subjectLoad(sem) {
               $.ajax({
                   url: "subject_load.php",
                   data: ({"semester": sem}),
                   dataType: "text",
                   success: function(data) {                       
                       
                        for(var i = 1; i <= 6; i++) {
                            for(var j = 1; j <=12; j++) {
                                if(j%2!=0) {
                                    var k = " ";
                                    k = i + "" + j;
                                    
                                    document.getElementById("t"+k).innerHTML = "<select onchange='onSubjectChange(event)' id=s"+k+" name=s"+k+">" + data + "</select>";
                                    
                                    
                                }
                            }
                        }
                       
                   }
               })
              setTimeout(f, 100);  
           }
           
           function f() {             
              var subject = document.getElementById("s11").value;
              $.ajax({
                   url: "faculty_load.php",
                   data: ({"semester": semester, "division" : division, "subject": subject}),
                   dataType: "text",
                   success: function(data) {
                        
                       for(var i = 1; i <= 6; i++) {
                            for(var j = 1; j <=12; j++) {
                                if(j%2==0) {
                                    var k = " ";
                                    k = i + "" + j;
                                    
                                    document.getElementById("t"+k).innerHTML = "<select id=s"+k+" name=s"+k+">" + data + "</select>"; 
                                    
                                }
                            }
                        }
                   }
               })
          }
           
           function onSubjectChange(event) {
                
                console.log(event.target.id);
               var i = event.target.id;
               var n = parseInt(i.slice(1))
               var id = n + 1;
               var subject = event.target.value;
               $.ajax({
                   url: "faculty_load.php",
                   data: ({"semester": semester, "division" : division, "subject": subject}),
                   dataType: "text",
                   success: function(data) {
                       document.getElementById("t"+id).innerHTML = "<select id=s"+id+" name=s"+id+">" + data + "</select>";  
                       console.log("what " + document.getElementById("s11").value);
                   }
               })
           }
       </script>
       

   </body>
</html>