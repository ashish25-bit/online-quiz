<?php
require 'database_connect.php';
    if(isset($_POST['signup'])){
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
        $category = mysqli_real_escape_string($conn,$_POST['category']);
        
        $sql_query = "SELECT id FROM users WHERE Email='$email'";
        if($r = mysqli_query($conn, $sql_query)){
            $rows = mysqli_num_rows($r);
            
            if($rows == 0){
                $query = "INSERT INTO users (Name , Email , Password , Category) VALUES ('$name' , '$email' , '$pwd' , '$category');";
                if(!mysqli_query($conn,$query)){
                    echo mysqli_error($conn);
                }
                $query = "SELECT id FROM users WHERE Email='$email'";
                if($res = mysqli_query($conn,$query)){
                    $row = mysqli_fetch_assoc($res);
                    session_start();
                    $_SESSION['userid'] = $row['id'];
                    if($category === "Examiner")
                        header("Location:../dashboard.php");
                    else if($category === "Examinee")
                        header("Location:../examinee.php");
                }   
                else 
                    echo mysqli_error($conn);
            }
            else
                header("Location:../signup.php?userAlreadyExists");
        }   
    }
?>