<!DOCTYPE html>
<html>
    <head>
        <title>How it works? - Online Exam Maker</title>
        <style>*{margin:0;padding:0;}
        .link_con{width:80%;background:#ccc;margin:0 auto;padding:10px;text-align:center;}
        .form{margin-bottom:10px;}
        .link{background:black;padding:7px 5px;cursor:pointer;border:none;color:white;}
        .id{width:50%;padding:6px 5px;}
        .get_id{cursor:pointer;color:blue;padding:5px;}
        .id_con{position:fixed;top:0;left:0;width:100%;height:100vh;background:rgba(0,0,0,0.5);display:flex;text-align:center;justify-content:center;align-items:center;display:none;}
        .id_main{min-width:100px;min-height:50px;padding:20px;background:white;}
        .id_main p{font-size:20px;}
        .id_class{pointer-events:none;padding:5px;margin:10px 0;}
        .ok,.copy{padding:6px; border:none; cursor:pointer; background:black; coloR:white;}
        </style>
    </head>
    <body>
        <?php require 'header.php';?>
        
        <div class="link_con">
            <form class="form" method="post">
                <input name="id" class="id" type="text" placeholder="Enter your exam Id" autocomplete="off"/>
                <input type="submit" name="submit" class="link" value="Proceed" />
            </form>
            <span class="get_id">Get Exam Id</span>
        </div>
        <div class="id_con">
            <div class="id_main">
                <p>Your exam Id is : </p>
                <input class="id_class" value = "<?php echo $_GET['uniqueId'] ?>" /><br/>
                <button class="ok">OK</button>
                <button class="copy">Copy</button>
            </div>
        </div>
        <script>
            let id = document.querySelector(".id");
            let get_id = document.querySelector(".get_id");

            document.querySelector(".link").addEventListener("click" , (event) => {
                if(id.value === "")
                    alert("Please Enter Exam Id.");
                else if(id.value !== "<?php echo $_GET['uniqueId'] ?>")
                    alert("Please Enter Correct Exam Id! To get your exam id click to 'Get Exam Id'.");
                else document.querySelector(".form").setAttribute("action" ,"include/make_paper_db.php")
            })

            document.querySelector(".ok").addEventListener("click" , () => {
                document.querySelector(".id_con").style.display = "none";
            })

            get_id.addEventListener("click" , () =>{
                document.querySelector(".id_con").style.display = "flex";
            })

            document.querySelector(".copy").addEventListener("click" , () => {
                let copyText = document.querySelector(".id_class")
                copyText.select();
                copyText.setSelectionRange(0,99999);
                document.execCommand("copy");
            })
        </script>
    </body>
</html>