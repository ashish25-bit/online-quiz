<?php require 'include/information.php';?>

<!DOCTYPE html>
<html>
    <head>
        <style>.wel{margin:20px;font-size:20px;text-transform:uppercase;}
        a{text-decoration:none;}
        .header{display:flex;width:90%;margin:0 auto;}
        .header div:nth-child(1){flex:3;}
        .header div:nth-child(2){flex:2;}
        .home{float:right;margin:20px;padding:6px 5px;font-size:18px;}
        .l_btn{float:right;margin:20px;padding:6px 5px;cursor:pointer;}</style>
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
                    <input type="submit" class="l_btn" name="logout" value="Logout"/>
                </form>
            </div>
        </div>
    </body>
</html>