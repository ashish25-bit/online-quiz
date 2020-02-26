<?php
session_start();
if(!isset($_SESSION['userid'])){
    echo "You are logged out";
    die();
}

require 'database_connect.php';
$id = $_SESSION['userid'];
$query_name = "SELECT Name,Email,Category,Password FROM users WHERE id='$id'";
if($result_name = mysqli_query($conn,$query_name)){
    $row_name = mysqli_fetch_assoc($result_name);
}
?>