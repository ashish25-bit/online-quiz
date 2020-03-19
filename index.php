<!DOCTYPE html>
<html>
    <head>
        <title>Online Paper Maker - Log In</title>
        <style>*{margin:0;padding:0;}
        a{text-decoration:none;}
        .header{margin:15px;}
        .form_login{width:80%;background:#ddd;margin:0 auto;padding:15px;text-align:center;}
        .email,.pwd{width:50%;margin:5px;padding : 10px 5px;}
        .login_btn{padding:6px 5px;margin:10px;cursor:pointer;}</style>
    </head>
    <body>
        <h1 class="header">Online Paper Maker</h1>
        <form class="form_login" method="POST">
            <input class="email" name="email" type="email" placeholder="Enter your email" value="sample@gmail.com">
            <input class="pwd" name="pwd" type="password" placeholder="Enter Password" value="1234"><br/>
            <input class="login_btn" type="submit" name="login" value="Login">
        </form><br/>
        <div class="msg"></div>
        <p style="margin-left:15px;">Not a member yet? <a href="signup.php">Signup here.</a></p>

        <script>
            let email = document.querySelector(".email");
            let pwd = document.querySelector(".pwd");
            
            document.querySelector('.login_btn').addEventListener("click" , function(event){
                if(email.value === "")
                    alert("Enter Email");
                else if (pwd.value === "")
                    alert("Enter Password");
                else
                    document.querySelector(".form_login").setAttribute("action" , "include/validate.php");
            })
        </script>
    </body>
</html>