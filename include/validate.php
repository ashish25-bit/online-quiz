<?php
require 'database_connect.php';
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
        
        $query = "SELECT Password,id,Category from users WHERE Email='$email'";
        if($res = mysqli_query($conn,$query)){
            if(mysqli_num_rows($res) > 0){
                $r = mysqli_fetch_assoc($res);
                $p = $r['Password'];
                if($p !== $pwd)
                    header("Location:../index.php?=wrongCredentials");
                else{
                    session_start();
                    $_SESSION['userid'] = $r['id'];
                    if($r['Category'] === 'Examiner')
                        header("Location:../dashboard.php");
                    else if($r['Category'] === 'Examinee') 
                        header("Location:../examinee.php");
                }
            }
            else
                header("Location:../index.php?=userDoesntExixts");
        }
        else
            mysqli_error($conn);
    }
?>