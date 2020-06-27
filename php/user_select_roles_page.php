<?php
    include('User.php');
    session_start();
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Comatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script type="text/javascript" src="jquery-3.3.1.js"> </script>
    <script>
        
    </script>
    <title>User - Home</title>
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

                <h3 style="vertical-align:middle; margin:auto; width: 100%;"><?php echo $user->getFirstName(); echo " " ;echo $user->getLastName(); ?></h3>

        </div> <!-- profile -->


        <div class="sidebar">

            <ul>
                <li><a href="http://localhost/whiteboard/php/student/student_profile.php" class="active">Select Role</a></li>
                <li><a href="http://localhost/whiteboard/php/student/student_profile.php" >Settings</a></li>
                <li><a href="http://localhost/whiteboard/php/student/student_aboutus.php">About us</a></li>
                <li><a href="http://localhost/whiteboard/cuber/cuber.html">Cuber Game</a></li>
                <li><a href="http://localhost/whiteboard/shootdemsquares/index.html">Shoot Dem Squares</a></li>
            </ul>
        </div><!--  sidebar -->
    </div> <!-- sidenel-->

    <section class="canvas">

        <div class="Search">
            <!-- Search form -->
            <form class="form-inline">

                <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div> <!-- end Search form -->

        <div class="btn1">
            <form action="http://localhost/whiteboard/php/user_logout.php" method="get">
               <input type="submit" class="but" value ="Log Out"/>
            </form>
        </div> <!-- btn -->

    </section> <!-- canavs -->



    <div class="news" style="width:80%; height:70%;">
        <div style="padding:2%;">
            <form method=get action="role_selection_student.php" id="role_selection_form">

                <h1 style="">
                    Please select Role
                </h1>

                <select style="margin-top:2%;" name="role" onchange="changeFormAction()" id="role">
                    <option value="student"> Student </option>
                    <option value="faculty"> Faculty </option>
                    <option value="hod"> Head of the department</option>
                    <option value="admin"> Admin </option>
                </select>
                
                <div id="student_enrolment">
                    <br>
                    <br>
                    Enrolment : 
                    <input type="text" name="enrolment"/>
                </div>
                
                <div id="select_branch">
                    <br>Please select Branch as well <br> <br> 
                    <select name='branch' id='branch' onchange="changeClassCoordinator()"> 
                        <option value='it'> Information Technology </option> 
                        <option value='ce'> Computer Engineering </option> 
                        <option value='me'> Mechanical Engineering 
                        </option> <option value='ee'> Electrical Engineering </option>
                    </select>
                    <br>
                </div>
                
                <div id="select_cc">
<!--
                    <br>Please select class coordinator as well <br> <br> 
                    <select name='branch' id='' onchange=> 
                        <option value='it'> Information Technology </option> 
                        <option value='ce'> Computer Engineering </option> 
                        <option value='me'> Mechanical Engineering 
                        </option> <option value='ee'> Electrical Engineering </option>
                    </select>
                    <br>
-->
                </div>
                
                
                <br>
                <input type="submit" value="okay"/>
                <br>
                <br>
                <span> Note : Please Sign out and Sign in back to reflect verfication changes</span>
                <br>
            </form>
        </div>
    </div>
    
    <script>
        function changeFormAction() {
            var role = document.getElementById('role').value;
            var branch = document.getElementById('select_branch');
            if(role == "hod" || role == "faculty" || role == "student") {
                branch.innerHTML = "<br>Please select Branch as well <br> <br> <select name='branch' id='branch' onchange='changeClassCoordinator()'> <option value='it'> Information Technology </option> <option value='ce'> Computer Engineering </option> <option value='me'> Mechanical Engineering </option> <option value='ee'> Electrical Engineering </option> </select> <br>";  
                if(branch==null) {
                    console.log("branch null hai");
                } else {
                    console.log('branch null nahi hai');
                }
            } else{
                branch.innerHTML = " ";
                document.getElementById('select_cc').innerHTML = " ";

            }
            
            //if student is selected
            //list all the faculties that have branch same as student
            if(role == 'student') {
                var b = document.getElementById('branch');    
                document.getElementById('student_enrolment').innerHTML = "<br><br>Enrolment : <input type='text' name='enrolment'/>"
                console.log("A" + document.getElementById('branch').value);
            } else {
                document.getElementById('student_enrolment').innerHTML = "";
            }
            
            //things that should be done actually in the function
            document.getElementById('role_selection_form').setAttribute('action', "role_selection_"+ role + ".php") ;
            
            if(role == 'student') {
                $.ajax({
                    url: "load_cc_dropdown.php",
                    dataType: "text",
                    data: ({"branch": document.getElementById('branch').value}),
                    success: function(data) {
                        $('#select_cc').html(data);
                        console.log(data);
                    }
                })
            } else {
                document.getElementById('select_cc').innerHTML = " ";
            }
        }
        
        function changeClassCoordinator() {
            console.log("what ");
            var role = document.getElementById('role').value;
            if(role == 'student') {
                $.ajax({
                    url: "load_cc_dropdown.php",
                    dataType: "text",
                    data: ({"branch": document.getElementById('branch').value}),
                    success: function(data) {
                        $('#select_cc').html(data);
                        console.log(data);
                    }
                })
            } else {
                document.getElementById('select_cc').innerHTML = " ";
            }
        }
        window.onload = changeClassCoordinator();
    </script>
    
  
</body>

</html>

<?php

    } else {
        echo "logged in j nathi pn";
    }
    
?>