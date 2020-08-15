<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Registration Form</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
      <link rel="stylesheet" href="lib/bxslider/dist/jquery.bxslider.min.css">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/registration.css">
   </head>
   <body>
      <!-- main container box  -->
      <div class="box">
         <!-- form box  -->
         <div class="co-form">
            <!-- heading of the form : White Board  -->
            <div class="heading">
               <h3 style="padding-bottom: 5px;">White Board</h3>
               <p style="font-size:20px; color: #888888;">Register to start using White Board</p>
            </div>
            <!-- the form itself  -->
            <div class="form1">
               <form action="http://localhost/whiteboard/php/user_registration.php" method="post">
                  <!-- name class  -->
                  <div class="name">
                     <!-- first name  -->
                     <div class="n-m" style="margin-right: 15px; display:inline; float:left;">
                        <span>First Name</span>
                        <input class="input100" type="text" name="firstname">
                     </div>
                     <!-- / firstname -->
                     <!-- last name  -->
                     <div class="n-m" style="display: inline;">
                        <span>Last Name</span>
                        <input class="input100" type="text" name="lastname" style="display: inline;width: 48%;">
                     </div>
                     <!-- / lastname -->
                  </div>
                  <!-- name -->
                  <div class="n-m">
                     <span>Email</span>
                     <input class="input100" type="email" name="email" style="width: 207%;">
                  </div>
                  <!-- email -->
                  <div class="Password">
                     <div class="n-m inline" style="margin-right: 15px">
                        <span>Password</span>
                        <input class="input100" type="password" name="password">
                     </div>
                     <div class="n-m inline">
                        <span>Confirm Password</span>
                        <input class="input100" type="password" name="confirmpassword">
                     </div>
                     <p style="font-size: 12px; color: #888888;">Use more than 8 characters with letters,numbers &amp; symbols.</p>
                  </div>
                  <!-- password -->
                  <div class="n-m" style="padding-top: 12px;">
                     <span>Contact</span>
                     <input class="input100" name="contact" style="width: 207%;">
                  </div>
                  <!-- contact -->
                  <div class="end">
                     <div>
                        <a href="http://localhost/whiteboard/php/user_login_page.php" class="login"><span>Log In instead</span></a>
                     </div>
                     <div>
                        <button type="submit" class="btn-f">SUBMIT</button>
                     </div>
                  </div>
                  <!-- end -->
               </form>
            </div>
            <!-- / form1 -->
            <!-- use ful links  -->
            <div class="help-aboutus">
               <a href="http://localhost/whiteboard/html/help.html">Help</a>
               <a href="http://localhost/whiteboard/html/about.html">About Us</a>
            </div>
         </div>
      </div>
   </body>
</html>