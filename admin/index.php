<?php
session_start();
include_once 'config.php';

if(isset($_SESSION['userName'])){
    header("location: admin/post.php");
}

if(isset($_POST['login'])){
    $name = mysqli_real_escape_string($connect, $_POST['username']);
    $pass = mysqli_real_escape_string($connect, $_POST['password']);
    $select = " select * from user_table where userName='$name' ";
    $select_q = mysqli_query($connect, $select);
    $row = mysqli_fetch_assoc($select_q);

    
    
    if(mysqli_num_rows($select_q)==1){
        $pass_verify = password_verify($pass, $row['userPass']);

       
        if($pass_verify==1){
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userName'] = $row['userName'];
                    $_SESSION['userRole'] = $row['userRole'];
                    header("location: admin/add-post.php");
        }
    }
    else{
        echo 'user name and password is not match';
    }




}

?>


<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <!-- <img src="./png-transparent-news-graphy-logo-icon-news-logo-text-photography-computer-wallpaper.png" alt=""> -->
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">

                    <div class="col-md-offset-4 col-md-4">
                    <?php
                        $select_setting = " select * from setting ";
                        $select_setting_q = mysqli_query($connect, $select_setting);
                        $row = mysqli_fetch_array($select_setting_q);
                        // echo "<pre>";
                        // print_r($row);
                        // die();
                    ?>
                    <a href="http://localhost:3000/"><img class="logo" width="200px" height="100px" src="images/".<?php echo $row[1];?> ></a>
                        
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
