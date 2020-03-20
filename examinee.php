<!DOCTYPE html>
<html>
    <head>
        <title>Student - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
        .wrapper{width:80%;margin:0 auto;text-align:center;position:relative;}  
        .form{width:100%;}
        .key{width:80%;padding:6px;}
        .btn{padding:6px;cursor:pointer;}
        .con{position:absolute;width:81.2%;left:39%;transform:translateX(-39%);box-shadow: -2px 2px 5px #888888;}
        .sub_con{padding:8px;margin:0 auto;cursor:pointer;}
        .sub_con:nth-child(odd),.registered_exam p:nth-child(odd){background:#ccc;}
        .sub_con:nth-child(even),.registered_exam p:nth-child(even){background:#ddd;}
        .results{width:80%;margin:20px auto;background:#eee;}
        .msg_key{margin:10px;}
        .result{width:100%;}
        .registered_exam{width:80%;margin:10px auto;background:#ccc;}
        .registered_exam p{padding:10px;}.reg_exam{cursor:pointer;} </style>
    </head>
    <body>
        <?php require 'header.php'; ?>
        <div class="wrapper">
            <form class="form" method="GET">
                <input class="key" type="text" name="key" placeholder="Enter Name or Exam Id"/>
                <input class="btn" type="submit" name="submit" value="Enter" />
            </form>
            <div class="con"></div>
        </div>

        <div class="results">
            <p class="msg_key"></p>
            <div class="result"></div>
        </div>

        <div class="registered_exam">
            <p>You have resgistered for following exam : </p>
            <?php $email = $row_name['Email'];
                $query = "SHOW TABLES FROM $dbName";
                $res = mysqli_query($conn,$query);
                while($row = mysqli_fetch_array($res)){
                    if($pos = strpos($row[0] , 'test')){
                        $q = "SELECT Email from $row[0] WHERE Email = '$email'";
                        if($r = mysqli_query($conn,$q)){
                            if(mysqli_num_rows($r) > 0){
                                $id = substr($row[0],0,$pos-1);
                                $q2 = "SELECT Title FROM exam_det WHERE UniqueId = '$id'";
                                $row_title = mysqli_fetch_assoc(mysqli_query($conn,$q2));
                                echo '<p class="reg_exam">'.$row_title['Title'].' - <span class="id">'.$id.'</span></p>';
                            }
                        }
                    }
                }
            ?>
        </div>

        <script>
            let con = document.querySelector(".con")
            let key = document.querySelector(".key")
            const res = document.querySelector(".result")
            const btn = document.querySelector(".btn")
            let msg_key = document.querySelector(".msg_key")
            let sub_con = document.querySelectorAll('.con div')
            const exam = document.querySelectorAll('.reg_exam')
            const id_test = document.querySelectorAll('.id')


            exam.forEach((ele,index) => {
                ele.addEventListener('click' , () => {
                    window.location = 'exam.php?id='+id_test[index].innerHTML
                })
            })

            btn.addEventListener("click" , (event) => {
                event.preventDefault()
                if(key.value !== ""){
                    if(window.XMLHttpRequest)
                        xmlhttp = new XMLHttpRequest()
                    else
                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')

                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                            msg_key.innerHTML = 'Search results for : ' + key.value
                            document.querySelector(".key").value = ''
                            res.innerHTML = xmlhttp.responseText
                            sub_con = document.querySelectorAll('.sub_con')
                            id = document.querySelectorAll('.uid')
                            sub_con.forEach((element,index) => {
                                element.addEventListener('click' , () => {
                                    window.location = 'exam.php?id='+id[index].innerHTML
                                })
                            })
                        }
                    }
                    con.innerHTML = ""
                    xmlhttp.open('GET', 'include/search_exam.php?key='+key.value, true)
                    xmlhttp.send()
                }
                else alert("Enter key")  
            })
        </script>
    </body>
</html>