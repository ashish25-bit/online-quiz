<?php
require 'database_connect.php';

if(isset($_POST['email'])){
    $text = $_POST['email'];
}
if(!empty($text)){
    $query = "SELECT Email FROM users WHERE Email='$text'";

    if($res = mysqli_query($conn,$query)){
        $row = mysqli_num_rows($res);
        if($row > 0)
            echo 'Email already registered. Change your email address.';
    }
}
?>