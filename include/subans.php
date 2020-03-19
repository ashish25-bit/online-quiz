<?php
    require 'information.php';
    $email = $row_name['Email'];
    $id = $_GET['id'];
    $n = $_GET['n'];
    $o = $_GET['o'];
    $t_name = $id . '_test';

    $q = "SELECT Answers FROM `$t_name` WHERE Email = '$email'";
    $r = mysqli_query($conn,$q);
    $row = mysqli_fetch_assoc($r);   
    $ans = $row['Answers'];
    $ans[$n*2] = $o;
    echo $ans;
    $query = "UPDATE `$t_name` SET Answers = '$ans' WHERE Email = '$email'";
    mysqli_query($conn,$query);   
?>