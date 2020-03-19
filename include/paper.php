<?php
require 'database_connect.php';
require 'information.php';

    // insert test details

    if(isset($_POST['submit'])){
        $email = $row_name['Email'];
        $title = $_POST['title'];
        $des = $_POST['des'];
        $date = $_POST['date'];
        $h = trim($_POST['hour']);
        $h = strlen($h) == 1 ? '0' . $h : $h;
        $m = trim($_POST['min']);
        $m = strlen($m) == 1 ? '0' . $m : $m;
        $time = $h . ':' . $m . " " . trim($_POST['meri']);
        $text = explode(" ",$title);
        $t = explode("-",$date);
        $uniqueId = strtolower($text[0]).$t[2]."_".rand(1000,100000);
        $duration = $_POST['duration'];
        $s = 0;
        $key = $_POST['key'];
        
        $query = "INSERT into exam_det (Email,UniqueId,Title,Des,Date,Time,Duration,State,Token) VALUES ('$email','$uniqueId','$title','$des','$date','$time','$duration',$s,$key);";
        if(!mysqli_query($conn,$query)){
            echo mysqli_error($conn);
            die();
        }
        else
            header("Location:../preview.php?id=$uniqueId");
    }

    // update test details

    if(isset($_POST['update'])){
        $des = $_POST['des'];
        $date = $_POST['date'];
        $h2 = trim($_POST['hour']);
        $h2 = strlen($h2) == 1 ? '0' . $h2 : $h2;
        $m2 = trim($_POST['min']);
        $m2 = strlen($m2) == 1 ? '0' . $m2 : $m2; 
        $time = $h2 . ':' . $m2 . " " . trim($_POST['meri']);
        $duration = $_POST['duration'];
        $uId = $_GET['uniqueId'];
        $key = $_POST['key'];
        $query = "UPDATE exam_det SET Des='$des', Date='$date', Time='$time', Duration='$duration', Token='$key' WHERE UniqueId='$uId'";
        if(!mysqli_query($conn,$query))
            header("Location:../preview.php?status=-1&id=$uId");
        else 
            header("Location:../preview.php?status=1&id=$uId");
    }
?>