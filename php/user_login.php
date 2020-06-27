<?php
    include('crypt.php');
    include('db_config.php');
    include('user.php');
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = encryption($password);
        //check for credentials
        $sql = "select * from user where email = '$email' and password = '$password'";
        if($results = $conn->query($sql)) {
            if($results->num_rows > 0) {
                //check for email verification
                if(checkEmailVerification($results, $email)) {
                    echo "login to thai gayu";
                    mysqli_data_seek($results, 0);
                    $row = $results->fetch_assoc();
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];
                    $password = $row['password'];
                    $contact = $row['contact'];
                    
                    error_log(print_r($row['id'], TRUE));
                    $id = $row['id'];
                    $user = new User($id, $firstname, $lastname, $email, $password, $contact);
                    session_start();
                    $_SESSION['user'] = $user;
                    echo $user->getFirstName();
                    header("Location: http://localhost/whiteboard/php/user_check_roles.php");
                   // session_destroy();
                } else {
                    //error
                    echo "status natu bhai";
                }
            } else {
                //sorry there was no such user error
                echo "there was no such user";
                //redirect them to user login page
            }
        } else {
            //error in sql 
            echo "sql ma error chhe";
        }
        
        
    } else {
        //error
        //redirect to user login page
        echo "error";
    }

    // this function checks email verification is done or not
    function checkEmailVerification($results, $email) {
        $rows = mysqli_fetch_assoc($results);
        
        if(strcmp($rows['email'], $email) == 0) {
            if($rows['status']) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    // this function checks for roles
    
?>