<!DOCTYPE html>
<html lang="en">
<head>
    <title>Exam Details - Online Paper Maker</title>
</head>
<style>
    *{margin:0;padding:0;}
    .info_con,.register_con,.deregister_con{width:80%;margin:0 auto;background:#ccc;padding:10px;}
    .register_con,.deregister_con{margin:10px auto;}
    .info_con p{font-size:20px;}
    .key_input{width:90%;margin:10px 0;padding:5px 6px;}
    .key_enter,.deregsiter,.quiz{margin:0 5px;font-size:15px; cursor:pointer;background:white;padding:6px 5px;border:none;font-family: 'Poppins', sans-serif;}
    .time{width:80%;background:#ccc;margin:10px auto;padding:10px;}
    .time p{padding:5px 6px;}
</style>
<body>
    <?php require 'header.php' ; $id = $_GET['id']?>
    <?php
        $query = "SELECT * from exam_det WHERE UniqueId = '$id'";
        if($res = mysqli_query($conn,$query)) {
            $row = mysqli_fetch_assoc($res);
            echo '<div class="info_con">';
            echo '<p style="font-size:25px">Name : '.$row['Title'].'</p>';
            echo '<p style="color:#777676">Exam Id : '.$row['UniqueId'].'</p>';
            echo '<p>Description : '.$row['Des'].'</p>';
            echo '<p>Date : '.$row['Date'].'</p>';
            echo '<p>Time : '.$row['Time'].'</p>';
            echo '<p>Duration : '.$row['Duration'] . ' minutes';
            echo '</div>';
        }
        else echo mysqli_error($conn);
    ?>
    <?php
        $test = $id . '_test';
        $email = $row_name['Email'];
        $query = "SELECT Email from $test WHERE Email = '$email'";
        $res = mysqli_query($conn,$query);
        $num = mysqli_num_rows($res);
        if($num  > 0){
            echo '<div class="deregister_con">';
            echo '<p>You have registered for this quiz.</p>';
            echo '<lable>De-register Here : </lable><button class="deregsiter">De-register</button>';
            echo '</div>';
        }
        else{
            echo '<div class="register_con">';
            echo '<p>Register for this exam here. Enter the exam key to register for the exam.</p>';
            echo '<input class="key_input" name="key" placeholder="Enter the exam key to register for the exam" autocomplete="off" type="text">';
            echo '<button class="key_enter">Register</button>';
            echo '</div>';
        }
    ?>

    <p class="msg"></p>

    <?php
        if($num > 0){
            echo "<script>
            let id = '$id'
            document.querySelector('.deregsiter').addEventListener('click' , () => {
                if(confirm('By Doing this you will be unable to give the exam.')){
                    if(window.XMLHttpRequest)
                        xmlhttp = new XMLHttpRequest()
                    else
                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
                    xmlhttp.onreadystatechange = function() {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        document.querySelector('.msg').innerHTML = xmlhttp.responseText
                    }
                    xmlhttp.open('GET', 'include/deregister.php?id='+id, true)
                    xmlhttp.send()
                }
            })
            </script>";
        }
        else{
            echo "<script>
            let id = '$id'
            const key = document.querySelector('.key_input')
            document.querySelector('.key_enter').addEventListener('click' , () => {
                if(key.value && !isNaN(key.value)){
                    if(window.XMLHttpRequest)
                    xmlhttp = new XMLHttpRequest()
                else
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
                xmlhttp.onreadystatechange = function() {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        document.querySelector('.msg').innerHTML = xmlhttp.responseText
                    }
                }
                param = 'id=' + id + '&key=' + key.value 
                xmlhttp.open('POST', 'include/register.php', true)
                xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
                xmlhttp.send(param)
                }
                else alert('Enter the exam key! It is a number')
            })
            </script>";
        }
    ?>
    
    <!-- 
    <div class="time"><p>No exam now ..</p></div>
    -->
    <?php
        $qq = "SELECT State FROM `$test` WHERE Email='$email'";
        $rrr = mysqli_query($conn,$qq);
        $roo = mysqli_fetch_assoc($rrr);
        $s = $roo['State'];
        if($roo['State'] == 0)
            echo '<div class="time"><p>Exam has started</p><button class="quiz">Attempt Quiz</button></div>';
        else 
            echo '<div class="no_time_to_die">You have attempted the quiz</div>';
    ?>

    <?php
        $today = date("Y-m-d");
        $tsd = explode('-', $today);
        $date = $row['Date'];
        $sd = explode('-', $date);
        $time = $row['Time'];
        $h = (int)substr($time,0,2);
        $m = (int)substr($time,3,5);
        $meri = substr($time,6,7);
        $h = $meri == 'AM' ? $h : $h < 12 ? $h + 12 : $h;
        $e = $h * 100 + $m;
        $d = $row['Duration'];
    ?>
    
    <script>

    document.querySelector('.quiz').addEventListener('click' , () => location.replace('quiz.php?id=' + '<?php echo $id ?>'))

    

    /*
    exam_date = '<?php echo $date ?>'
    curr_date = '<?php echo $today ?>'
    exam_time = '<?php echo $e ?>'
    duration = '<?php echo $d ?>'
    state = '<?php echo $s ?>'
    form = '<p>Exam has started</p><button class="quiz">Attempt Quiz</button>'

    {
        if(state == 0){
            setInterval(() => {
                d = new Date()
                curr_time = d.getHours() * 100 + d.getMinutes()

                if(exam_date === curr_date) {
                    if( curr_time - exam_time >=0  && (curr_time - exam_time <= 30 || curr_time - exam_time <= 70) ){
                        document.querySelector('.time').innerHTML = form
                        document.querySelector('.quiz').addEventListener('click' , () => location.replace('quiz.php?id=' + '<?php echo $id ?>'))
                    }
                }
            },1000)
        }
    }    
    */
    </script>
    
</body>
</html>