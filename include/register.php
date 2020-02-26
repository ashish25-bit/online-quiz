<?php
require 'database_connect.php';
require 'information.php';
$id = $_POST['id'] ;
$test = $id . '_test';
$key = (int)$_POST['key'] ;

$query = "SELECT Token from exam_det WHERE UniqueId = '$id'";
if($r = mysqli_query($conn,$query)){
    $row = mysqli_fetch_assoc($r);
    if((int)$row['Token'] === $key){
        $name = $row_name['Name'];
        $email = $row_name['Email'];
        $q = "INSERT INTO $test (Name,Email,Answers,Score) VALUES ('$name' , '$email' , '' , 0);";
        if(mysqli_query($conn,$q)) echo 'You have registered for this exam successfully.';
        else echo mysqli_error($conn);
    }
    else echo '<p style="color:red">Exam key is not correct! Please try again</p>';
}
else echo mysqli_error($conn);
?>