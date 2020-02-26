<!DOCTYPE html>
<html>
    <head>
        <title>Add Answers - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
        .pas_veri{width:100%;height:100vh;position:fixed;top:0;left:0;display:flex;text-align:center;justify-content:center;align-items:center;background:black;flex-direction:column;}
        .pass{padding:6px;width:50%;margin:10px 0;}
        .enter{padding:8px;border:none;cursor:pointer;}.error{color:red;margin:10px 0;}
        .con{width:80%;margin:0 auto;}
        .sub_con{padding:10px;background:#ccc;margin:10px 0;}
        .add{padding:5px;background:black;color:white;position:relative;top:10px;cursor:pointer;}
        .add_ques{padding:6px;background:black;color:white;cursor:pointer;}
        .add_ans{cursor:pointer;margin:0 5px} </style>
    </head>
    <body>
        <?php require 'header.php';?>

        <div class="pas_veri">
            <input type="password" class="pass" placeholder="Enter Password..." />
            <button class="enter">Enter</button>
            <p class="error"></p>
        </div>
        <script>
        let pwd = '<?php echo $row_name['Password'] ;?>'
        let pass = document.querySelector(".pass")
        let enter = document.querySelector(".enter")
        let pas_veri = document.querySelector(".pas_veri")
        enter.addEventListener("click" , () =>{
            if(pass.value != ""){
                if(pass.value === pwd)
                    pas_veri.style.display = "none"
                else 
                    document.querySelector(".error").innerHTML = "Incorrect Password!"
            }
            else 
                alert("Enter password to see the answers")
        })
        </script>
        <div class="con">
            <div class="f_con"><a class="add_ques">Add Questions</a></div>
            <div class="wrapper">
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
                            $a = $row['Answer'];
                            echo 'Answer : <span class="ans">'. $a .'</span><select class="ans_val">
                                    <option> </option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>D</option>
                                </select>';
                            echo '<button class="add_ans" title="'.$row['Id'].'">Add</button>';
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
        </div>

        <script>

        const add_ans = document.querySelectorAll(".add_ans")
        const ans_val = document.querySelectorAll(".ans_val")
        const ans = document.querySelectorAll(".ans")

        document.querySelector(".add_ques").addEventListener("click" , () =>{
            window.location = "add_questions.php?id="+'<?php echo $id ?>';
        })
        
        add_ans.forEach((element,index) =>{
            element.addEventListener("click" , () =>{
                let a = parseInt(element.getAttribute("title"))

                if(ans_val[index].value != ""){
                    if(window.XMLHttpRequest)
                        xmlhttp = new XMLHttpRequest()
                    else
                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            ans[index].innerHTML = xmlhttp.responseText
                    }
                    param = 'id='+'<?php echo $id ?>'+'&num='+a+'&ans='+ans_val[index].value
                    ans_val[index].value = ""
                    xmlhttp.open('POST', 'include/ans.inc.php', true)
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
                    xmlhttp.send(param)
                }
                else 
                    alert("Select Answer")
            })
        })

        </script>
    </body>
</html>