<?php
require 'database_connect.php';

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $query = "CREATE TABLE $id(
        Id int(11) PRIMARY KEY AUTO_INCREMENT not null,
        Ques varchar(500) not null,
        Option1 varchar(100) not null,
        Option2 varchar(100) not null,
        Option3 varchar(100) not null,
        Option4 varchar(100) not null,
        Answer varchar(1) not null
    )";
    if(!mysqli_query($conn,$query))
        mysqli_error($conn);
    else{
        $s = 1;
        $query2 = "UPDATE exam_det SET State='$s'WHERE UniqueId='$id'";
        mysqli_query($conn,$query2);
        $test = $id . "_test";
        $q = "CREATE TABLE $test(
            Name varchar(20) not null,
            Email varchar(30) not null,
            Answers varchar(100) not null,
            Score int(10) not null,
            timestamp TIMESTAMP NULL
        )";
        if(mysqli_query($conn,$q))
            header("Location:../add_questions.php?id=$id");
        else 
            echo mysqli_error($conn);
    }
}

//UPDATE `exam_det` SET State = 0
?>