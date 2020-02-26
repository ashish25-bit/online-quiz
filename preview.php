<!DOCTYPE html>
<html>
    <head>
        <title>Preview - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
        .con{width:80%;margin:5px auto;background:#eee;padding:10px;}
        .des_con{width:100%;background:#eee;}
        .title,.des_head{font-size:25px;}
        .id{font-size:18px;color:#aaa;}
        .edit,.add_ques,.add,.edit_ques{margin:0 5px;font-size:15px; cursor:pointer;background:white;padding:6px 5px;}
        .add_ques,.add{display:none}
        .btn_con{width:80%;margin:10px auto;background:black;text-align:center;padding:10px;}
        .update_det{text-align:center;color:red;}
        .show_con,.hide_con{display:inline-block;} </style>
    </head>
    <body>
        <?php require 'header.php';?>
        <?php
         $id = $_GET['id'];
         $query = "SELECT * FROM exam_det WHERE UniqueId='$id'";
         if($res = mysqli_query($conn,$query)){
             $row = mysqli_fetch_assoc($res);
         }
         else
             die();
        ?>

        <div class="con">
            <div class="test_det">
                <p class="title"><?php echo $row['Title'];?></p>
                <p class="id">Exam Id : <?php echo $id;?></p>
            </div>
            <div class="des_con">
                <p class="des_head">Test Details : </p>
                <p class="name_con">This test is conducted by <?php echo $row_name['Name']?></p>
                <p class="des"><?php echo $row['Des'] ?></p>
                <p class="date">Test will be conducted on <?php $date = $row['Date']; $d = explode("-",$date); echo $d[2] . "/" . $d[1] . "/" . $d[0] ;?></p>
                <p class="time">Time : <?php echo $row['Time'] ?></p>
                <p class="duration">Test Duration : <?php echo $row['Duration'] ." minutes" ?></p>
                <p class="token">Token :<span class="msg_token">*****</span>
                    <div class="show_con"><input class="pwd" type="password" name="pwd" placeholder="Enter Password"><button class="show_token">Show</button></div>
                    <div class="hide_con"><button class="hide">Hide</button></div>
                </p>
                <p>(Students have to enter this TOKEN to register in the exam.)</p>
            </div>
        </div>
        <div class="btn_con">
            <a class="edit">Edit Details</a>
            <a class="add">Add Questions</a>
            <a class="add_ques">Add</a>
            <a class="edit_ques">Edit Questions</a>
            <?php $q = "SELECT State FROM exam_det WHERE UniqueId='$id'";
                if(!mysqli_query($conn,$q))
                    echo mysqli_error($conn);
                else {
                    $res = mysqli_query($conn,$q);
                    $r = mysqli_fetch_assoc($res);
                }?>
        </div>
        <p class="update_det"><?php error_reporting(0);
            if($_GET['status'] == 1) echo 'Test details Updated.';
            else if($_GET['status'] == -1) echo 'There was an error in updating the details.';?></p>

        <script>
            document.querySelector(".edit").addEventListener("click" , () => {
                window.location = 'update_exm_det.php?uniqueId='+"<?php echo $id ?>";
            });

            {
                state = "<?php echo $r['State'] ?>"
                if(state == 1){
                    document.querySelector(".add").style.display = "inline-block"
                    document.querySelector(".edit_ques").style.display = "inline-block"
                    document.querySelector(".add_ques").style.display = "none"
                }

                else{
                    document.querySelector(".add_ques").style.display = "inline-block"
                    document.querySelector(".add").style.display = "none"
                    document.querySelector(".edit_ques").style.display = "none"
                }
                document.querySelector(".hide").style.display = 'none'
            }

            document.querySelector(".add").addEventListener("click" , () => {
                window.location = 'add_questions.php?id='+"<?php echo $id ?>";
            })

            document.querySelector(".add_ques").addEventListener("click" , () => {
                window.location = 'demo.php?uniqueId='+"<?php echo $id ?>";
            })
            document.querySelector(".edit_ques").addEventListener("click" , () =>{
                window.location = 'edit_ques.php?id='+"<?php echo $id ?>"
            })

            document.querySelector(".show_token").addEventListener("click" , ()=>{

                if(document.querySelector(".pwd").value != ""){
                    if(window.XMLHttpRequest)
                            xmlhttp = new XMLHttpRequest()
                    else
                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')

                    
                    document.querySelector(".hide_con").style.display = "inline-block"
                    document.querySelector(".show_con").style.display = "none"

                    xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        document.querySelector(".msg_token").innerHTML = xmlhttp.responseText;
                    }
                    pwd = document.querySelector(".pwd").value
                    document.querySelector(".hide").style.display = 'inline'
                    document.querySelector(".pwd").value = ""
                    param = "id="+'<?php echo $id ?>'+"&pwd="+pwd
                    xmlhttp.open('POST', 'include/get_token.php', true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send(param);
                }
                else 
                    alert("Enter password to See Exam Token")
            })

            document.querySelector(".hide").addEventListener("click" , () =>{
                document.querySelector(".msg_token").innerHTML = '*****'
                document.querySelector(".show_con").style.display = "inline-block"
                document.querySelector(".hide_con").style.display = "none"
            })
        </script>
    </body>
</html>