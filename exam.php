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
    .key_enter,.deregsiter{padding:5px 6px;cursor:pointer;}
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
            document.querySelector('.key_enter').addEventListener('click' , () =>{
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

    <div class="time">
        <p>Exams starts in : 
        <?php
        $q2 = "SELECT Date FROM exam_det WHERE UniqueId='$id'";
        if($r = mysqli_query($conn,$q2)){
            $row2 = mysqli_fetch_assoc($r);
            $date = $row2['Date'];
            $d = explode('-' , $date);
            $d_c = $d[2] . '-' . $d[1] . '-' . $d[0];
            $today = getdate();
            echo $today['mday'] . '-' . $today['mon'] . '-' . $today['year'];
        }
        else echo mysqli_error($conn);
        ?>
        </p>
    </div>
    
</body>
</html>