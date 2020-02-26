<!DOCTYPE html>
<html>
    <head>
        <title>Update Exam Details - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
        .con{width:90%;margin:0 auto;background:#eee;padding:20px;}
        .title{font-size:20px;}
        .uniqueId{font-size:16px;color:#aaa;}
        .form{width:80%;margin:20px auto;background:#ddd;padding:10px;text-align:center;}
        .des{width:50%;height:300px;padding:6px 5px;margin:5px;resize:none;}
        .btn{padding:6px 5px;cursor:pointer;}
        .date{margin:5px;}
        .time{width:20px;margin:5px;}
        .duration{margin:10px;width:50px;text-align:center;}
        .key{margin-bottom:10px;padding:6px;}
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {-webkit-appearance: none;margin: 0;}
        </style>
    </head>
    <body>
        <?php
            require 'header.php';
            require 'include/database_connect.php';
            $uId = $_GET['uniqueId'];
            $query = "SELECT * FROM exam_det WHERE UniqueId='$uId'";
            if($res = mysqli_query($conn , $query)){
                $row = mysqli_fetch_assoc($res);
            }
        ?>
        <div class="con">
            <p class="title"><?php echo $row['Title'] ?></p>
            <p class="uniqueId" ><?php echo $uId ?></p>
        </div>
        <form class="form" method="POST">
            <textarea type="text" class="des" name="des" placeholder="Enter Test Details"></textarea><br/>
            <label>Enter Date : </label>
            <input type="date" name="date" class="date" title="Enter Date you want to conduct your test. Your test will automatically be Uploaded" /><br/>
            <label>Enter Time : </label>
            <input type="text" class="time hour" name="hour" title="Enter number from 1-12" /> : 
            <input type="text" class="time min" name="min" title="Enter a number from 00-59" /> 
            <input type="radio" value="AM" class="meri" name="meri"/>AM  <input type="radio" class="meri" value="PM" name="meri" />PM <br/>
            <label>Duration : </label>
            <input type="number" name="duration" class="duration" /><label> min</label><br/>
            <label>Key : </label>
            <input class="key" name="key" type="text" placeholder="Enter Token"/> <br/>
            <input type="submit" class="btn" name="update" value="Update" data-username = "{{result[\'username\']}}"/>
        </form>
        <script>
        <?php
            $time = $row['Time'];
            $pos = strpos($time , "M"); 
            $meri = substr($time,($pos-1));
            $h = substr($time,0,$pos-1);
            $hour = explode(":",$h);
            $key = $row['Token'];
        ?>
        let des = document.querySelector(".des");
        let date = document.querySelector(".date");
        let hour = document.querySelector(".hour");
        let min = document.querySelector(".min");
        let meri = document.querySelectorAll(".meri");
        let key = document.querySelector(".key");
        let m = "<?php echo $meri ?>";
        let duration = document.querySelector(".duration");
        {
            des.value = "<?php echo $row['Des'] ?>";
            date.value = "<?php echo $row['Date'] ?>";
            duration.value = "<?php echo $row['Duration'] ?>";
            hour.value = "<?php echo $hour[0] ?>";
            min.value = "<?php echo $hour[1] ?>";
            key.value = "<?php echo $key ?>";
            if(m === 'AM')
                meri[0].checked = true;
            else 
                meri[1].checked = true;
        }

            document.querySelector(".btn").addEventListener("click" , (event) => {
                if (des.value === ""){
                    alert("Fill the description");
                    event.preventDefault();
                }
                else if(date.value === ""){
                    alert("Fill Date field");
                    event.preventDefault();
                }
                else if(hour.value === ""){
                    alert("Enter hour field");
                    event.preventDefault();
                }
                else if(min.value === ""){
                    alert("Enter minute field");
                    event.preventDefault();
                }
                else if(key.value === ""){
                    alert("Enter key field");
                    event.preventDefault();
                }
                else{
                    let min_int = parseInt(min.value);
                    let hour_int = parseInt(hour.value);
                    if(hour_int<=0 || hour_int>12){
                        event.preventDefault();
                        alert("Enter Hour between 01 and 12");
                    }
                    else if(min_int<0 || min_int>59){
                        event.preventDefault();
                        alert("Enter Minute between 00 and 59");
                    }
                    else{
                        text = "<?php echo $uId ?>";
                        document.querySelector(".form").setAttribute("action" , "include/paper.php?uniqueId="+text);
                    }
                }
            })
        </script>
    </body>
</html>