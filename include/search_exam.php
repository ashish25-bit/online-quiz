<?php
require 'database_connect.php';
if(isset($_GET['key'])){
    $key = $_GET['key'];
}

if(!empty($key)){
    $query = "SELECT Title, UniqueId FROM exam_det WHERE Title LIKE '$key%'";
    if($res = mysqli_query($conn,$query)){
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res))
                echo '<div class="sub_con">'.$row['Title'].' - <span class="uid">'.$row['UniqueId'].'</span></div>';
        }
        else echo '<div class="sub_con">No results</div>';
    }
    else mysqli_error($conn);
}
?>