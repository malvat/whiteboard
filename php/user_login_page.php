<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
      <link rel="stylesheet" href="lib/bxslider/dist/jquery.bxslider.min.css">
      <link rel="stylesheet" type="text/css" href="http://localhost/whiteboard/css/login.css" media="all">
   </head>
   <body>
      <div class="box">
         <div class="co-form">
            <div class="heading">
               <h3 style="padding-bottom: 5px; text-align: center;">White Board</h3>
               <h4 style="font-size: 20px; color: #888888; text-align: center;">Sign in</h4>
               <p style="font-size:20px; color: #888888; text-align: center;">to start using White Board</p>
            </div>
            <div class="form1">
               <form action="http://localhost/whiteboard/php/user_login.php" method="post">
                  <div class="name" style="width: 100%;">
                     <div class="n-m" style="margin-right: 15px; width: 100%; ">
                        <span>Email</span>
                        <input class="input100" type="text" name="email">
                     </div>
                     <!-- enrolment-->
                     <div class="n-m" style="width: 100%;">
                        <span>Password</span>
                        <input class="input100" type="password" name="password">
                        <div style="padding-top: 10px; font-size: 14px;">
                           <a href="http://localhost/whiteboard/php/user_password_forgot_page.php"> Forgot your password ?</a>
                        </div>
                        <?php 
                           if(isset($_GET['error_msg'])) {
                           	echo "<div style='color: #b00020; padding-top: 10px; font-size: 14px;'>".$_GET['error_msg']."</div>";
                           }
                           ?>
                     </div>
                     <!-- password -->
                  </div>
                  <!-- name -->
                  <div class="end">
                     <div>
                        <a href="http://localhost/whiteboard/php/user_registration_page.php" class="login"><span>Create an account</span></a>
                     </div>
                     <div>
                        <button type="submit" class="btn-f">Log in</button>
                     </div>
                  </div>
                  <!-- end -->
               </form>
            </div>
            <!-- form1 -->
            <div class="help-aboutus">
               <a href="http://localhost/whiteboard/html/help.html">Help</a>
               <a href="http://localhost/whiteboard/html/about.html">About Us</a>
            </div>
         </div>
         <!-- co-form -->
      </div>
      <!-- box -->
   </body>
</html>