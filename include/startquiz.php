<?php
require 'information.php';
$id = $_GET['id'];
$l = $_GET['l'];
$email = $row_name['Email'];
$t_name = $id . '_test';

$q = "SELECT timestamp FROM $t_name WHERE Email = '$email'";

if($r = mysqli_query($conn,$q)){
    $row = mysqli_fetch_assoc($r);
    if($row['timestamp'] == ''){
        $a = '';
        for($i=0;$i<$l;$i++)
            $a = $a . 'X' . ',';
        $ans = substr($a , 0, strlen($a) - 1);
        $query = "UPDATE $t_name SET Answers = '$ans', timestamp = now() WHERE Email= '$email'";
        if(mysqli_query($conn,$query))
            echo 'Quiz started';
        else 
            echo mysqli_error($conn);
    }
    else 
        echo $row['timestamp'];
}
else
    echo mysqli_error($conn);
?>