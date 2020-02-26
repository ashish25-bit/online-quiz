<!DOCTYPE html>
<html>
    <head>
        <title>Online Paper Maker - Examiner</title>
        <style>*{margin:0;padding:0;}
            .form{width:80%;margin:0 auto;background:#ddd;padding:10px;text-align:center;}
            .test_title{width:50%;padding:6px 5px;margin:5px;}
            .des{width:50%;height:300px;padding:6px 5px;margin:5px;resize:none;}
            .btn{padding:6px 5px;cursor:pointer;}
            .date{margin:5px;}
            .time{width:20px;margin:5px;}
            .duration{margin:10px;width:50px;text-align:center;}
            .key{margin-bottom:10px;padding:6px;}
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {-webkit-appearance: none;margin: 0;}</style>
    </head>
    <body>
        <?php require 'header.php'?>
        <form class="form" method="POST">
            <input type="text" class="test_title" name="title" placeholder="Enter Test Title"/>
            <textarea type="text" class="des" name="des" placeholder="Enter Test Details"></textarea><br/>
            <label>Enter Date : </label>
            <input type="date" name="date" class="date" title="Enter Date you want to conduct your test. Your test will automatically be Uploaded" /><br/>
            <label>Enter Time : </label>
            <input type="text" class="time hour" name="hour" title="Enter number from 1-12" /> : 
            <input type="text" class="time min" name="min" title="Enter a number from 00-59" /> 
            <input type="radio" value="AM" name="meri" checked />AM  <input type="radio" value="PM" name="meri" />PM <br/>
            <label>Duration : </label>
            <input type="number" name="duration" class="duration" /><label> min</label><br/>
            <label>Key : </label>
            <input class="key" name="key" type="text" placeholder="Enter Token"/> <br/>
            <input type="submit" class="btn" name="submit" value="Submit"/>
        </form>
        <script>
            let title = document.querySelector(".test_title");
            let des = document.querySelector(".des");
            let date = document.querySelector(".date");
            let h = document.querySelector(".hour");
            let m = document.querySelector(".min");
            let key = document.querySelector(".key")

            document.querySelector(".btn").addEventListener("click" , function(event){
                if(title.value === ""){
                    if(des.value !== "" || date.value !== "" || h.value !== "" || m.value !== "" || key.value !== "")
                        event.preventDefault();
                    alert("Enter Title");
                }
                else if(des.value === ""){
                    if(title.value !== "" || date.value !== "" || h.value !== "" || m.value !== "" || key.value !== "")
                        event.preventDefault();
                    alert("Enter the details of the test");
                }
                else if(date.value === ""){
                    if(title.value !== "" || des.value !== "" || h.value !== "" || m.value !== "" || key.value !== "")
                        event.preventDefault();
                    alert("Enter Date");
                }
                else if(h.value === ""){
                    if(title.value !== "" || des.value !== "" || date.value !== "" || m.value !== "" || key.value !== "")
                        event.preventDefault();
                    alert("Enter hour field");
                }
                else if(m.value === ""){
                    if(title.value !== "" || des.value !== "" || date.value !== "" || h.value !== "" || key.value !== "")
                        event.preventDefault();
                    alert("Enter minute field");
                }
                else if(key.value === ""){
                    if(des.value !== "" || date.value !== "" || h.value !== "" || m.value !== "" || title.value !== "")
                        event.preventDefault();
                    alert("Enter Key");
                }
                else{
                    let min = parseInt(m.value);
                    let hour = parseInt(h.value);
                    if(hour<=0 || hour>12){
                        event.preventDefault();
                        alert("Enter Hour between 01 and 12");
                    }
                    else if(min<0 || min>59){
                        event.preventDefault();
                        alert("Enter Minute between 00 and 59");
                    }
                    else
                        document.querySelector(".form").setAttribute("action" , "include/paper.php");
                }
            })
        </script>
    </body>
</html>