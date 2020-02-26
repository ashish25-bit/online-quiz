<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
            a{text-decoration:none;}
            .quiz_det{width:90%;margin:3px auto;background:#ddd;padding:10px;height:70px;}
            .quiz_name{font-size:20px;cursor:pointer;}
            .uniqueId{font-size:16px;color:#aaa;display:inline;}
            .create{text-align:center;margin:40px;}
            .create a{padding:6px;color:white;background:black;}
            .none{text-align:center;font-size:20px;}
            .edit{padding:6px;font-size:15px;position:relative;top:10px;margin-right:10px; cursor:pointer;background:white;}</style>
    </head>
    <body>
        <?php
            require 'header.php';
            require 'include/database_connect.php';
            $email = $row_name['Email'];
            $query = "SELECT Email,Title,UniqueId from exam_det WHERE Email='$email'";
            if($res = mysqli_query($conn,$query)){
                if(mysqli_num_rows($res)>0){
                    while ($row = mysqli_fetch_assoc($res)){
                        echo '<div class="quiz_det">';
                        echo '<a class="quiz_name">'.$row['Title'].'</a><br/>';
                        echo '<p class="uniqueId">'.$row['UniqueId'].'</p><br/>';
                        echo '<a class="edit">Edit Details</a>';
                        echo '</div>';
                        #data-username = "{{result[\'username\']}}"
                    }
                }
                else
                    echo '<p class="none">No Quiz Conducted.</p>';
            }
        ?>
        <div class="create"><a href="exam_det.php">Create Exam</a></div>
        <script>
            const uId = document.querySelectorAll(".uniqueId");
            const quiz_name = document.querySelectorAll(".quiz_name");
            const edit = document.querySelectorAll(".edit");

            edit.forEach( (element,index) =>{
                element.addEventListener("click" , () =>{
                    window.location = 'update_exm_det.php?uniqueId='+uId[index].innerHTML;
                })
            })

            quiz_name.forEach( (element,index) => {
                element.addEventListener("click" , () => {
                    window.location = "preview.php?id="+uId[index].innerHTML;
                })
            }) 
        </script>
    </body>
</html>