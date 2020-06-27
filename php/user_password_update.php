<?php
    require('db_config.php');
    require('crypt.php');
    $email = $_GET['email'];
    echo "$email";
    $password = $_POST['password'];
    $password = encryption($password);
    $sql = "update user set password = '$password' where email = '$email'";
    if($conn->query($sql)) {
        echo "thai gayu change";
    } else {
        echo "nai thayu ";
    }
?>