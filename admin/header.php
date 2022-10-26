<?php
include_once 'config.php';
session_start();

if (!$_SESSION['userName']) {
    header("location: $root/admin");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="./png-transparent-news-graphy-logo-icon-news-logo-text-photography-computer-wallpaper.png" type="image/x-icon">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-2">
                    <?php
                        $select_setting = " select * from setting ";
                        $select_setting_q = mysqli_query($connect, $select_setting);
                        $row = mysqli_fetch_array($select_setting_q);
                    ?>
                    <a href="http://localhost:3000/"><img class="logo" width="200px" height="100px" src="images/<?php echo $row['logo'];?>"></a>
                </div>
                <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-md-offset-8  col-md-2">
                    <?php
                    // if ($_SESSION['userName']){
                    //     echo '<a href="" class="admin-logout">'.$_SESSION["userName"].'</a>';
                    // }
                    // ?>
                    <a href="logout.php" class="admin-logout"><?php echo "Hello ". $_SESSION['userName']." "; ?>logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>
                        <?php
                    if ($_SESSION['userRole'] == 1) {
                        ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>  <li>
                                <a href="setting.php">Setting</a>
                            </li>
                        <?php
                    }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->