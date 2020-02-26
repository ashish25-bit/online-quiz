<!DOCTYPE html>
<html>
    <head>
        <title>Edit Questions - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
        html{scroll-behavior:smooth;}
        .con{width:80%;margin:0 auto;}
        .sub_con{padding:10px;background:#ccc;margin:10px 0;}
        textarea{resize:none;width:100%;padding:6px;margin:5px 0;}
        .form_con{width:100%;background:#ccc;display:none}
        .form{width:80%;margin:5px auto;padding:10px;}
        .btn_con{text-align:center;width:100%;}
        .update,.delete_ques,.update_ques,.close{padding:6px; background:black; color:white; cursor:pointer;border:none;margin-right:5px;}
        .add{padding:5px;background:black;color:white;position:relative;top:10px;cursor:pointer;}
        .ques{height:50px;}
        .f_con{width:80%;margin:0 auto;}
        .add_ques{padding:6px;background:black;color:white;cursor:pointer;} </style>
    </head>
    <body>
        <?php require 'header.php' ?>
        <div id="top"></div>
        <div class="f_con"><a class="add_ques">Add Questions</a></div>
        <div class="form_con">
            <form method="POST" class="form">
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
            <div class="btn_con"><input type="submit" class="update" name="update" value="Update" onclick="insert(event)" /><button class="close">Close</button></div>
            </form>
        </div>
        <p class="msg"></p>
        <div class="con">
            <?php
            $id = $_GET['id'];
            $query = "SELECT * from $id ";
            if($res = mysqli_query($conn,$query)){
                if(mysqli_num_rows($res) > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo '<div class="sub_con">';
                        echo '<p class="qr">'.$row['Ques'].'</p>';
                        echo '<p class="or1">'.$row['Option1'].'</p>';
                        echo '<p class="or2">'.$row['Option2'].'</p>';
                        echo '<p class="or3">'.$row['Option3'].'</p>';
                        echo '<p class="or4">'.$row['Option4'].'</p>';
                        echo '<button class="update_ques" title="'.$row['Id'].'" >Update</button>';
                        echo '<button class="delete_ques" onclick="delete_ques(event,'.$row['Id'].')">Delete</button>';
                        echo '</div>';
                    }
                }
                else {
                    echo '<p>No Questions Entered</p>';
                    echo '<a class="add">Add Questions</a>';
                    echo '<script>
                    document.querySelector(".add").addEventListener("click" , () =>{
                        window.location = "add_questions.php?id="+\''.$id.'\'
                    })
                    </script>';
                    die();
                }
            }
            else 
                echo mysqli_error($conn);
            ?>
        </div>
        <script>
            
            let num = 0;
            const ques = document.querySelector(".ques")
            const option1 = document.querySelector(".option1")
            const option2 = document.querySelector(".option2")
            const option3 = document.querySelector(".option3")
            const option4 = document.querySelector(".option4")
            const sub_con = document.querySelectorAll(".sub_con")
            const x = document.querySelectorAll(".update_ques")
            
            x.forEach( (element,index) => {
                element.addEventListener("click" , (event) =>{
                    let a = parseInt(element.getAttribute("title"))
                    document.querySelector(".form_con").style.display = "block"
                    const ques = document.querySelector(".ques")
                    const option1 = document.querySelector(".option1")
                    const option2 = document.querySelector(".option2")
                    const option3 = document.querySelector(".option3")
                    const option4 = document.querySelector(".option4")
                    const sub_con = document.querySelectorAll(".sub_con")   
                    con = sub_con[index]    
                    ques.value = con.querySelector(".qr").innerHTML
                    option1.value = con.querySelector(".or1").innerHTML
                    option2.value = con.querySelector(".or2").innerHTML
                    option3.value = con.querySelector(".or3").innerHTML
                    option4.value = con.querySelector(".or4").innerHTML
                    document.body.scrollTop = 0
                    document.documentElement.scrollTop = 0
                    num = a
                })
            })
            
            function insert(event){
                event.preventDefault()
                if(ques.value === "" || option1.value === "" || option2.value === "" || option3.value === "" || option4.value === "")
                    alert("Enter all the fields")
                
                else{
                    if(window.XMLHttpRequest)
                        xmlhttp = new XMLHttpRequest()
                    else
                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')

                    xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        document.querySelector(".con").innerHTML = xmlhttp.responseText;
                        ques.value=""
                        option1.value="" 
                        option2.value="" 
                        option3.value=""
                        option4.value=""
                        }
                    }
                    document.querySelector(".form_con").style.display = "none"
                    param = 'ques='+ques.value+'&id='+'<?php echo $id ?>'+'&option1='+option1.value+'&option2='+option2.value+'&option3='+option3.value+'&option4='+option4.value+'&num='+num
                    xmlhttp.open('POST', 'include/update.inc.php', true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send(param);
                }
            }

            function delete_ques(event,n){
                if(confirm("Do you want to delete this ques?")){
                    console.log(n)
                    if(window.XMLHttpRequest)
                        xmlhttp = new XMLHttpRequest()
                    else
                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')

                    xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        document.querySelector(".con").innerHTML = xmlhttp.responseText
                    }

                    param = 'id='+'<?php echo $id ?>'+'&num='+n
                    xmlhttp.open('POST', 'include/delete.inc.php', true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send(param);
                }
            }

            document.querySelector(".add_ques").addEventListener("click" , () =>{
                window.location = "add_questions.php?id="+'<?php echo $id ?>';
            })

            document.querySelector(".close").addEventListener("click" , () =>{
                document.querySelector(".form_con").style.display = "none"
            })
        </script>
    </body>
