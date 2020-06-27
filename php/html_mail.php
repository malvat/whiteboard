<?php
$to = 'malvat.anim0@gmail.com';

$subject = 'Website Change Reqest';

$headers = "From: anim@malvat.com"  . "\r\n";


$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$message = '<form action="localhost/projectv2/php/user_login_page.php"> <input type="submit" value="okay"/></form>';


if(mail($to, $subject, $message, $headers)) {
    echo "done";
} else {
    echo "not done";
}

?>