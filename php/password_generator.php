<html>
    <head>
    </head>
    <body>
        <form action="http://localhost/projectv2/php/password_generator.php" method="get">
            <h1>
                Enter your password to generated encrypted password
            </h1>
            <input type="text" name="password"/>
            <input type="submit" value="okay"/>
        </form>
    </body>
</html>

<?php
    include('crypt.php');
    if(isset($_GET['password'])) {
        echo encryption($_GET['password']);
    } else {
       // header("location: http://localhost/projectv2/php/password_generator.php");
    }

?>