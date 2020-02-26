<?php
    require 'database_connect.php';
    require 'information.php';
    $pwd = $_POST['pwd'];
    $id = $_POST['id'];
    $email = $row_name['Email'];

    $q = "SELECT Password from users WHERE Email = '$email'";
    if($re = mysqli_query($conn,$q)){
        if(mysqli_num_rows($re) > 0){
            $r = mysqli_fetch_assoc($re);
            $p = $r['Password'];
            if($p !== $pwd)
                echo 'Enter correct Password';
            else{
                $query = "SELECT Token FROM exam_det WHERE UniqueId='$id'";
                if($res = mysqli_query($conn,$query)){
                    $row = mysqli_fetch_assoc($res);
                    echo $row['Token'];
                }
            }
        }
    }
?>