<?php
require 'database_connect.php';
$id = $_POST['id'];
$num = (int)$_POST['num'];

$query = "DELETE FROM $id WHERE Id = '$num'";
if(mysqli_query($conn,$query)){
    $q = "SELECT * FROM $id";
    if($r = mysqli_query($conn,$q)){
        while($row = mysqli_fetch_assoc($r)){
            echo '<div class="sub_con">';
            echo '<p class="qr">'.$row['Ques'].'</p>';
            echo '<p class="or1">'.$row['Option1'].'</p>';
            echo '<p class="or2">'.$row['Option2'].'</p>';
            echo '<p class="or3">'.$row['Option3'].'</p>';
            echo '<p class="or4">'.$row['Option4'].'</p>';
            echo '<button class="update_ques" title="'.$row['Id'].'" >Update</button>';
            echo '<button class="delete_ques" onclick="delete_ques(event,'.$row['Id'].')">Delete</button>';
            echo '</div>';
        }
    }
}
else 
    echo mysqli_error($conn);

?>