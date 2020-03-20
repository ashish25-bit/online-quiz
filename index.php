<!DOCTYPE html>
<html>
    <head>
        <title>Online Paper Maker - Log In</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <style>*{margin:0;padding:0;}
        body,.login_btn{font-family: 'Poppins', sans-serif;}
        .container{background-image: linear-gradient(90deg,blue, #1d1535);width:100%;height:100vh;}
        a{text-decoration:none;}
        .login_form_con{text-align:center;position:absolute;top:30%;left:50%;transform:translate(-50%,-50%);width:450px;background:#25295b;padding:20px;border-radius:60px;box-shadow:3px 3px 3px black, -2px -2px 3px white;}
        .email,.pwd{width:350px;margin:10px 0;padding:8px;outline:none;border-radius:50px;border:1px #ccc solid;}
        .header{color:white;margin:10px 0;}
        .login_btn{margin:20px;width:360px;background:#237194;padding:5px;border-radius:50px;border:none;cursor:pointer;color:white;letter-spacing:1.4px;}
        .signup{background:#787a87;color:white;padding:5px;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="login_form_con">
                <h1 class="header">Online Paper Maker</h1>
                <form class="form_login" method="POST">
                    <input class="email" name="email" type="email" placeholder="Enter your email" value="ashishyoel23@gmail.com">
                    <input class="pwd" name="pwd" type="password" placeholder="Enter Password" value="1234"><br/>
                    <input class="login_btn" type="submit" name="login" value="LOGIN">
                </form>
                <p style="color:white">Not a member yet? <a class="signup" href="signup.php">Signup here.</a></p>
            </div>
        </div>

        <script>
            let email = document.querySelector(".email");
            let pwd = document.querySelector(".pwd");
            
            document.querySelector('.login_btn').addEventListener("click" , function(event){
                if(email.value === "" || pwd.value === ""){
                    event.preventDefault()
                    alert('Fill All Fields!!')
                }
                else
                    document.querySelector(".form_login").setAttribute("action" , "include/validate.php");
            })
        </script>
    </body>
</html>