<?php
    require 'database_connect.php';
    $id = $_GET['id'];
    $n = $_GET['n'];
    $query = "SELECT Ques,Option1,Option2,Option3,Option4 FROM `$id` WHERE Id = $n";
    if($res = mysqli_query($conn,$query)){
        $row = mysqli_fetch_assoc($res);
        echo '<p class="ques">Ques : ' . $row['Ques'] .'</p>
        A : <input type="radio" class="option" name="option" value="' . $row["Option1"] .'">'.$row["Option1"].'<br/>
        B : <input type="radio" class="option" name="option" value="' . $row["Option2"] .'">'.$row["Option2"].'<br/>
        C : <input type="radio" class="option" name="option" value="' . $row["Option3"] .'">'.$row["Option3"].'<br/>
        D : <input type="radio" class="option" name="option" value="' . $row["Option4"] .'">'.$row["Option4"];
    }
?>