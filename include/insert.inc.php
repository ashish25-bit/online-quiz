<?php
require 'database_connect.php';
$ques = mysqli_real_escape_string($conn,$_POST['ques']);
$id = $_POST['id'];
$o1 = mysqli_real_escape_string($conn,$_POST['option1']);
$o2 = mysqli_real_escape_string($conn,$_POST['option2']);
$o3 = mysqli_real_escape_string($conn,$_POST['option3']);
$o4 = mysqli_real_escape_string($conn,$_POST['option4']);
$ans = 'X';

$query = "INSERT INTO $id (Ques,Option1,Option2,Option3,Option4,Answer) VALUES ('$ques' , '$o1' , '$o2' , '$o3' , '$o4' , '$ans');";
if(!mysqli_query($conn,$query))
    echo mysqli_error($conn);
else {
    $q2 = "SELECT Id FROM $id";
    if($res = mysqli_query($conn,$q2)){
        $count = 1;
        while($row = mysqli_fetch_assoc($res))
            echo '<div>Question '.$count++.'</div>';
    }
}
?>
