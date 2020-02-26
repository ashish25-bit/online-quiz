<!DOCTYPE html>
<html>
    <head>
        <title>Online Paper Maker - Sign Up</title>
        <style>*{margin:0;padding:0;}
            .head{text-align: center;margin:15px;}
            .form_signup{width:80%;background:#ddd;margin:0 auto;padding:15px;text-align:center;}
            .name,.email,.pwd{width:50%;margin:5px;padding : 10px 5px;}
            .btn{padding:6px 5px;margin:10px;cursor:pointer;}</style>
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
    <h2 class="head">Online Paper Maker</h2>
    <form class="form_signup" method="POST">
        <label>Sign up as : </label>
        <input type="radio" name="category" value="Examiner" checked>Examiner
        <input type="radio" name="category" value="Examinee">Examinee <br/>
        <input class="name" name="name" type="text" placeholder="Enter your name"/>
        <input class="email" name="email" type="email" placeholder="Enter your email" onkeyup="findEmail()"/>
        <div class="msg"></div>
        <input class="pwd" name="pwd" type="password" placeholder="Enter Password"/><br/>
        <input class="btn" name="signup" type="submit" value="Signup"/>
    </form>
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