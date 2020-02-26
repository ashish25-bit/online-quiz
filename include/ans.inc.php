<?php 
require 'database_connect.php';
$id = $_POST['id'];
$num = $_POST['num'];
$ans = $_POST['ans'];
$query = "UPDATE $id SET Answer='$ans' WHERE Id='$num'";
if(mysqli_query($conn,$query))
    echo $ans;
else 
    echo 'Try Again'
?>