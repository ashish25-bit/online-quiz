<!DOCTYPE html>
<html>
    <head>
        <title>Questions - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
        .wrapper{width:95%; display:flex;margin:0 auto;}
        .wrapper div{margin:0 5px;}
        .form_con{flex:3;}
        .side_con{flex:1;width:100%;max-height,min-height:77vh;background:#ccc;}
        .side_con_head{text-align:center; margin:5px 0; font-size:17px;}
        .form{background:#ccc;padding:14px;}
        textarea{resize:none;width:98%;padding:10px;}
        .form p{font-size:17px;margin:10px 0;}
        .ques{height:50px;}
        .btn_con{width:100%;margin:5px auto;text-align:center;}
        .btn{padding:6px; background:black; color:white; cursor:pointer;border:none;}
        .edit,.add_ans{margin:10px;padding:5px;background:black;color:white;position:relative;top:2px;cursor:pointer;}
        .ques_con{width:100%;margin:10px auto; background:#ccc;padding:6px;}
        .q{font-size:20px;margin:5px 0;}
        .o{font-size:18px;margin:5px 0;}
        .sub_ques_con{display:flex;flex-wrap:wrap;text-align:center;align-items:center;justify-content:center;}
        .sub_ques_con div{background:black;color:white;margin:5px;padding:6px;width:25%;}
        .msg_con{width:95%;margin:10px auto;background:#ccc;}
        .msg p{margin:10px 0;}  
        .ques_res,.o4_res,.o2_res,.o3_res,.o1_res{padding:6px;background:black;color:white;}.u_d_msg{text-align:center;margin:10p 0; color:red;} </style>
    </head>
    <body>
        <?php require 'header.php';?>
        <div class="wrapper">
            <div class="side_con">
                <p class="side_con_head">Question List : </p>
                <div class="sub_ques_con">
                <?php
                    $id = $_GET['id'];
                    $q2 = "SELECT Id FROM $id";
                    if($res = mysqli_query($conn,$q2)){
                        if(mysqli_num_rows($res)>0){
                            $count = 1;
                            while($row = mysqli_fetch_assoc($res))
                                echo '<div>Question '.$count++.'</div>';
                            }
                            else
                            echo '<div>No Questions has been entered</div>';
                        }
                ?>
                </div>
            </div>
            <div class="form_con">
                <form class="form" method="POST">
                    <p>Question : </p>
                    <textarea name="ques" type="text" class="ques" placeholder="Enter question"></textarea>
                    <p>Option A : </p>
                    <textarea name="option1" type="text" class="option option1" placeholder="Enter option"></textarea>
                    <p>Option B : </p>
                    <textarea name="option2" type="text" class="option option2" placeholder="Enter option"></textarea>
                    <p>Option C : </p>
                    <textarea name="option3" type="text" class="option option3" placeholder="Enter option"></textarea>
                    <p>Option D : </p>
                    <textarea name="option4" type="text" class="option option4" placeholder="Enter option"></textarea>
                    <div class="btn_con">
                        <input type="submit" class="btn" name="submit" value="Insert" onclick="insert(event)" />
                        <a class="edit">Edit Questions</a>
                        <a class="add_ans">Add Answers</a>
                    </div>
                </form> 
            </div>
        </div>

        <div class="msg_con">
            <div class="msg"></div>
        </div>

        <script>
        const ques = document.querySelector(".ques")
        const option1 = document.querySelector(".option1")
        const option2 = document.querySelector(".option2")
        const option3 = document.querySelector(".option3")
        const option4 = document.querySelector(".option4")
        const sub_con = document.querySelectorAll(".sub_ques_con div")

        function insert(event){
            event.preventDefault()
            if(ques.value === "" || option1.value === "" || option2.value === "" || option3.value === "" || option4.value === "")
                alert("Enter all the fields")

            else {
                if(window.XMLHttpRequest)
                    xmlhttp = new XMLHttpRequest();
                else
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        document.querySelector(".sub_ques_con").innerHTML = xmlhttp.responseText;
                        ques.value=""
                        option1.value="" 
                        option2.value="" 
                        option3.value=""
                        option4.value=""
                        }
                    }
                    param = 'ques='+ques.value+'&id='+'<?php echo $_GET['id'] ?>'+'&option1='+option1.value+'&option2='+option2.value+'&option3='+option3.value+'&option4='+option4.value;
                    xmlhttp.open('POST', 'include/insert.inc.php', true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send(param);
                }
            }

            document.querySelector(".edit").addEventListener("click", () =>{
                window.location = "edit_ques.php?id="+'<?php echo $id ?>'
            })

            document.querySelector(".add_ans").addEventListener("click" , () =>{
                window.location = "add_answer.php?id="+'<?php echo $id ?>'
            })
        </script>
    </body>
</html>
