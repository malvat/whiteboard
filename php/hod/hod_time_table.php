<?php 
    require('../db_config.php');
    require('../hod.php');
    require('../user.php');
    session_start();
    $user = $_SESSION['user'];
    if(!isset($_SESSION['user'])){
        header("http://localhost/whiteboard/php/user_login_page.php");
    } else {
        $user = $_SESSION['user'];
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
    }
    

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Comatible" content="IE-edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HOD - Home</title>
      <!-- 	<link rel="shortcut icon" type="images/X" href="imgs\M.png"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
      <link rel="stylesheet" href="lib/bxslider/dist/jquery.bxslider.min.css">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/main.css ">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/responsive.css">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn&apos;t work if you view the page via file:// -->
      <!--[if lt IE 9]>	<script src="<a href="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script">https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script</a>>	<script src="<a href="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script">https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script</a>>	<![endif]-->
   </head>
   <body>
      <div class="side_panel">
         <div class="profile" style="text-align:center;width: 100%;">
            <img src="http://localhost/whiteboard/images/3.jpeg" class="img-circle" alt="Cinque Terre" align="center" width="100" height="100">
            <h3 style="vertical-align:middle; margin:auto; width: 100%;"><?php echo $firstname; echo " " ;echo $lastname; ?></h3>
         </div>
         <!-- profile -->
         <div class="sidebar">
            <ul>
               <li><a href="http://localhost/whiteboard/php/hod/hod_home.php">Home</a></li>
               <li><a href="http://localhost/whiteboard/php/hod/hod_assign_subject.php">Subject Assigning</a></li>
               <li><a href="#" class="active">Time Table Commitee</a></li>
               <li><a href="#">Schedule</a> </li>
               <li><a href="#">About us</a></li>
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
             <div class="news" style="width:60%; left:30%; height:70%; padding-top: 4%;">
                 <h1 style="font-size: 24px;">
                    Please select a faculty to provide tt role to them
                 </h1>
                 <br>
                 <form action="http://localhost/whiteboard/php/hod/time_table_commitee_assigned.php">
                     <div style="height:50%;">
                         <?php
                            $hod = $_SESSION['hod'];
                            $branch = $hod->getBranch();
                            $sql = "select * from faculty inner join user on faculty.user_id = user.id where branch = '$branch'";
                            if($results = $conn->query($sql)) {
                                echo "<select name='faculty' id ='faculty'>";
                                while($row = $results->fetch_assoc()) {
                                    $id = $row['user_id'];
                                    echo "<option value='$id'>";
                                    echo $row['firstname'];
                                    echo " ";
                                    echo $row['lastname'];
                                    echo "</option>";
                                }
                                echo "</select>";
                            } else {
                                echo "There was some error in fetching the names, please try again later";
                            }
                         ?>
                     </div>
                     <br>
                     <input type="submit" value="okay"/>
                     
                     
                 </form>
                 <div>

                 </div>
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