<?php
    include('db_config.php');
    $sql = "select * from user";
    $results = $conn->query($sql);
    echo "<select>";
    while($row = $results->fetch_assoc()) {
        echo "<option>".$row['firstname']." ".$row['lastname']."</option>";
    }
    echo "</select> ";
echo "what the hell";
echo    $_GET['anim'];

?>