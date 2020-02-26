<?php
require 'database_connect.php';

$id = $_POST['id'];
$num = (int)$_POST['num'];
$ques = $_POST['ques'];
$o1 = $_POST['option1'];
$o2 = $_POST['option2'];
$o3 = $_POST['option3'];
$o4 = $_POST['option4'];

$query = "UPDATE $id SET Ques='$ques', Option1='$o1', Option2='$o2', Option3='$o3' , Option4='$o4' WHERE Id = '$num' ";
if(mysqli_query($conn,$query)){
    $q = "SELECT * from $id ";
    if($res = mysqli_query($conn,$q)){
        while($row = mysqli_fetch_assoc($res)){
            echo '<div class="sub_con">';
            echo '<p class="qr">'.$row['Ques'].'</p>';
            echo '<p class="or1">'.$row['Option1'].'</p>';
            echo '<p class="or2">'.$row['Option2'].'</p>';
            echo '<p class="or3">'.$row['Option3'].'</p>';
            echo '<p class="or4">'.$row['Option4'].'</p>';
            echo '<button class="update_ques" onclick="update(event,'.$row['Id'].')">Update</button>';
            echo '<button class="delete_ques" onclick="delete_ques(event,'.$row['Id'].')">Delete</button>';
            echo '</div>';
        }
    }
}
else
    echo mysqli_error($conn);
?>