<!DOCTYPE html>
<html>
    <head>
        <title>Online Paper Maker - Sign Up</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <style>*{margin:0;padding:0;}
            body{color:white}
            body,.btn{font-family: 'Poppins', sans-serif;}
            a{text-decoration:none;}
            .container{background:#202556;width:100%;height:100vh;}
            .signup_form_con{text-align:center;position:absolute;top:30%;left:50%;transform:translate(-50%,-50%);width:450px;background:#25295b;padding:20px;border-radius:60px;box-shadow:3px 3px 3px black, -2px -2px 3px white;}
            .header{color:white;margin:10px 0;}
            .name,.email,.pwd{width:350px;margin:10px 0;padding:8px;outline:none;border-radius:50px;border:1px #ccc solid;}
            .btn{margin:20px;width:360px;background:#237194;padding:5px;border-radius:50px;border:none;cursor:pointer;color:white;letter-spacing:1.4px;}
            .signup{color:#787a87;padding:5px;}
            </style>
        <script>
            function findEmail(){
                if(window.XMLHttpRequest)
                    xmlhttp = new XMLHttpRequest();
                else
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        document.querySelector(".msg").innerHTML = xmlhttp.responseText;
                }
                param = 'email='+document.querySelector(".email").value;
                xmlhttp.open('POST', 'include/search.inc.php', true);
                xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xmlhttp.send(param);
            }
        </script>
    </head>
    <div class="container">
        <div class="signup_form_con">
            <h1 class="header">Online Paper Maker</h1>
            <form class="form_signup" method="POST">
                <label style="color:white">Sign up as : </label>
                <input type="radio" name="category" value="Examiner" checked>Examiner
                <input type="radio" name="category" value="Examinee">Examinee <br/>
                <input class="name" name="name" type="text" placeholder="Enter your name"/>
                <input class="email" name="email" type="email" placeholder="Enter your email" onkeyup="findEmail()"/>
                <div class="msg"></div>
                <input class="pwd" name="pwd" type="password" placeholder="Enter Password"/><br/>
                <input class="btn" name="signup" type="submit" value="SIGNUP"/>
            </form>
            <p style="color:white">Already a member? <a class="signup" href="index.php">Login here.</a></p>
        </div>
    </div>
    <script>
        let name = document.querySelector(".name");
        let email = document.querySelector(".email");
        let pwd = document.querySelector(".pwd");
        let msg = document.querySelector(".msg");
        const btn = document.querySelector(".btn");
        btn.addEventListener("click", function(){
            if(name.value === "")
                alert("Enter name");
            else if(email.value === "")
                alert("Enter email");
            else if(pwd.value === "")
                alert("Enter password");
            else 
                document.querySelector(".form_signup").setAttribute("action" , "include/insert.php");
        })
    </script>
</html>