<?php
    include 'information.php';
    $t_name = $_GET['id'] . '_test';
    $email = $row_name['Email'];
    $query = "SELECT Answers FROM `$t_name` WHERE Email = '$email'";
    $r = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($r);
    echo $row['Answers'];
?>