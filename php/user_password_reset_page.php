<?php
    require('db_config.php');
    $allowed = 0;   
    if(isset($_GET['verification_code']) && isset($_GET['email'])) {
        $code = $_GET['verification_code'];
        $email = $_GET['email'];
        echo $code;
        echo $email;
        $sql = "select * from user inner join password_forgot on user.id = password_forgot.user_id where email = '$email' and verification_code = '$code'";
        if($results = $conn->query($sql)) {
            if($results -> num_rows >0) {
                $allowed = 1;
                echo "there are record";
            } else {
                $allowed = 0;
                echo "there are no records";
            }
        } else {
            echo "dbms ma locha chhe ";
        }
    
    
?>
    
<?php 
    if($allowed == 1) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
	<link rel="stylesheet" href="lib/bxslider/dist/jquery.bxslider.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/projectv1/css/login.css" media="all">

</head>

<body>
	<div class="box">
		<div class="co-form">
			<div class="heading">
				<h3 style="padding-bottom: 5px; text-align: center;">White Board</h3>
				<h4 style="font-size: 20px; color: #888888; text-align: center;">Reset Your Password</h4>
				<p style="font-size:20px; color: #888888; text-align: center;">Try to use new password</p>
			</div>
			<div class="form1">
				<form action="http://localhost/projectv2/php/user_password_update.php?email=<?php echo $email ?> " method="post">
					<div class="name" style="width: 100%;">
						

						<div class="n-m" style="width: 100%;">
							<span>Password</span>

							<input class="input100" type="password" name="password">
                        </div> <!-- password -->
                            <div style="font-size: 14px; width:100%;" class="n-m">
                                <span>Confirm Password</span>
                                <input class="input100" type="password" name="cpassword">
                            </div>
                            
							<?php 
								if(isset($_GET['error_msg'])) {
									echo "<div style='color: #b00020; padding-top: 10px; font-size: 14px;'>".$_GET['error_msg']."</div>";
								}
							?>
                            
						
					</div> <!-- name -->

					

					<div class="end">

						<a href="http://localhost/projectv1/index.html" class="login"><span>Create an account</span></a>
						<div class="co-btn">

							<button type="submit" class="btn-f inline">Reset</button>
						</div>

					</div>  <!-- end -->


				</form>
			</div><!-- form1 -->
			<div class="help-aboutus">
				<a href="http://localhost/projectv1/html/help.html">Help</a>
				<a href="http://localhost/projectv1/html/about.html">About Us</a>
			</div>
		</div> <!-- co-form -->

	</div> <!-- box -->
</body>

</html>

<?php 
    } else {
        echo "sorry";
        //redirect
    } 
    }
?>