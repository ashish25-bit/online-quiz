<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
    *{margin:0;padding:0;}
    .start{text-align:center;}
    .quiz_start{margin:0 5px;font-size:15px; cursor:pointer;background:black;color:white;padding:6px 5px;border:none;font-family: 'Poppins', sans-serif;}
    .quiz_con{width:100%;}
    .ques_con,.pagination{background:#ccc;width:80%;margin:20px auto;padding:10px;}
    .pagination{background:white;text-align:center;}
    .ques{margin:10px 0;font-size:18px;}
    .option{margin:10px 0;cursor:pointer;}
    .title{text-align:center;font-size:20px;margin:10px;}
    .page_con{list-style:none;}
    .page_con li{display:inline-block;background:#ccc;margin:0 5px;padding:10px 18px;border-radius:50%;cursor:pointer;}
    .finish{text-align:center;}
    .finish_btn{font-size:15px;outline:none;cursor:pointer;color:white;background:black;padding:6px 5px;border:none;font-family: 'Poppins', sans-serif;}
    </style>
</head>
<body>
    <?php require 'include/information.php' ; $id = $_GET['id']?>

    <?php 
        $q_name = "SELECT Title FROM `exam_det` WHERE UniqueId = '$id'";
        $rn = mysqli_query($conn,$q_name);
        $title = mysqli_fetch_assoc($rn);
        echo '<p class="title">' . $title['Title'] . '</p>';
    ?>

    <div class="start">
        <button class="quiz_start">Start The quiz</button>
    </div>

    <?php
        $qid = [];
        $query = "SELECT Id FROM $id";
        if($r = mysqli_query($conn,$query)){
            while($row = mysqli_fetch_assoc($r))
                array_push($qid, $row['Id']);
        }
        else
            echo mysqli_query($conn);
    ?>

    <div class="quiz_con">
        <div class="ques_con">
            <?php
                $query = "SELECT Ques,Option1,Option2,Option3,Option4 FROM `$id` WHERE Id = $qid[0]";
                if($res = mysqli_query($conn, $query)){
                    $row = mysqli_fetch_assoc($res);
                    echo '<p class="ques">Ques : ' . $row['Ques'] .'</p>';
                    echo 'A : <input type="radio" class="option" name="option" value="' . $row['Option1'] .'"> '.$row['Option1'].'<br/>';
                    echo 'B : <input type="radio" class="option" name="option" value="' . $row['Option2'] .'">'.$row['Option2'].'<br/>';
                    echo 'C : <input type="radio" class="option" name="option" value="' . $row['Option3'] .'">'.$row['Option3'].'<br/>';
                    echo 'D : <input type="radio" class="option" name="option" value="' . $row['Option4'] .'">'.$row['Option4'];
                }
            ?>
        </div>
        <div class="pagination">
            <?php
                echo '<ul class="page_con">';
                for($i=1;$i<=count($qid);$i++)
                    echo '<li>'.$i.'</li>';
                echo '</ul>';
            ?>
        </div>
        <div class="finish"><button class="finish_btn">Finish</button></div>
    </div>

    <script>
        o = ['A' , 'B' , 'C' , 'D'] 
        id = '<?php echo $id ?>'
        l = '<?php echo count($qid) ?>'
        qid = <?php echo json_encode($qid) ?>

        {document.querySelector('.quiz_con').style.display = 'none'}

        document.querySelector('.quiz_start').addEventListener('click' , () => {
            if(window.XMLHttpRequest)
                xmlhttp = new XMLHttpRequest()
            else
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            
            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    console.log(xmlhttp.responseText)
                }
            }

            xmlhttp.open('GET', `include/startquiz.php?id=${id}&l=${l}`, true)
            xmlhttp.send()

            document.querySelector('.start').style.display = 'none'
            document.querySelector('.quiz_con').style.display = 'block'

            if(window.XMLHttpRequest)
                xmlhttp = new XMLHttpRequest()
            else 
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    ans = xmlhttp.responseText
                    sessionStorage.Ans = ans
                    current_ques(0)
                }
            }
            xmlhttp.open('GET', `include/getans.php?id=${id}`)
            xmlhttp.send()
        })

        document.querySelectorAll('.page_con li').forEach((element,index) => {
            element.addEventListener('click' , () => {
                if(window.XMLHttpRequest)
                    xmlhttp = new XMLHttpRequest()
                else
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.querySelector('.ques_con').innerHTML = xmlhttp.responseText
                        current_ques(index)
                    }
                }
                xmlhttp.open('GET', `include/get_ques.php?id=${id}&n=${qid[index]}`, true)
                xmlhttp.send()
            })
        })

        function current_ques(i){
            options = document.querySelectorAll('.option')

            selected = sessionStorage.Ans
            ca = selected[i*2]

            options.forEach((element,index) => {

                if(ca != 'X') {
                    if(ca == 'A')
                        options[0].checked = true
                    else if(ca == 'B')
                        options[1].checked = true
                    else if(ca == 'C')
                        options[2].checked = true
                    else if(ca == 'D')
                        options[3].checked = true
                }

                element.addEventListener('click' , () => {

                    if(window.XMLHttpRequest)
                        xmlhttp = new XMLHttpRequest()
                    else
                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
                    xmlhttp.onreadystatechange = function() {
                        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                            ans = xmlhttp.responseText
                            sessionStorage.Ans = ans
                        }
                    }
                    xmlhttp.open('GET' , `include/subans.php?id=${id}&n=${i}&o=${o[index]}`,true)
                    xmlhttp.send()
                })
            }) 
        }        

        document.querySelector('.finish_btn').addEventListener('click' , () => {
            if(confirm('Do you want to finish your exam and submit your answers?')) {
                sessionStorage.clear()
                location.replace('include/finish_exam.php?id=' + id)
            }
        })
         
    </script>

</body>
</html>