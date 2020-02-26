<?php
    if(isset($_POST['logout'])){
        session_start();
        session_unset();
        header("Location:../index.php");
    }
?>