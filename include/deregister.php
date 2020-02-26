<?php
require 'database_connect.php';
require 'information.php';
$id = $_GET['id'];
$test = $id . '_test';
$email = $row_name['Email'];
$query = "DELETE FROM $test WHERE Email = '$email'";
if(!mysqli_query($conn,$query)) echo 'Unable to de-register you. PLease try again';
else echo 'Deleted Successfully';
?>