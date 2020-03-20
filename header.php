<?php require 'include/information.php';?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <style>
        body,.l_btn{font-family: 'Poppins', sans-serif;}
        .wel{font-size:20px;text-transform:uppercase;color:white;padding:5px}
        a{text-decoration:none;}
        .header{display:flex;width:90%;background:#237194;padding:15px 20px;margin:20px auto;border-radius:50px;}
        .header div:nth-child(1){flex:3;}
        .header div:nth-child(2){flex:2;}
        .home{float:right;color:white;margin:0 20px;padding:5px;}
        .l_btn{float:right;cursor:pointer;padding:5px 6px;margin-right:40px;background:#787A87;color:white;letter-spacing:1.4px;border:none;}</style>
    </head>
    <body>
        <div class="header">
            <div><p class="wel"><?php echo "Welcome " . $row_name['Name']; ?></p></div>
                <?php 
                    if($row_name['Category'] != 'Examinee')
                        echo '<div><a href="dashboard.php" class="home">Home</a> </div>';
                ?>
            <div>
                <form action="include/logout.php" method="POST">
                    <input type="submit" class="l_btn" name="logout" value="LOGOUT"/>
                </form>
            </div>
        </div>
    </body>
</html>