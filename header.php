<?php
include_once 'config.php';

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
$select_setting = " select * from setting ";
$select_setting_q = mysqli_query($connect, $select_setting);
$logo_img = mysqli_fetch_assoc($select_setting_q);

// echo "<h1>". basename($_SERVER['PHP_SELF'])."</h1>";
$pageName = basename($_SERVER['PHP_SELF']);
switch ($pageName) {
    case "author.php":
        // echo "Author page";
        if(isset($_GET['id'])){
            $sql = " SELECT * from user_table where user_id = {$_GET['id']} ";
            $sql_result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($sql_result);
            $page_title = "Name ".$row['firstName']." ".$row['lastName'];
        }
        else{
            $page_title = "author page is not found";
        }
        break;
    case "category.php":
        // echo "Category page";
        if(isset($_GET['id'])){
            $sql = " SELECT * from category where categoryId = {$_GET['id']} ";
            $sql_result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($sql_result);
            $page_title = $row['categoryName']. " news";
        }
        else{
            $page_title = "category in not found";
        }
        break;
    case "search.php":
        // echo "Search page";
        if(isset($_GET['search'])){
            // $select_search = " SELECT * from post_table ";
            // $select_search_q = mysqli_query($connect, $select_search);
            // $row = mysqli_fetch_assoc($select_search_q);
            // $page_title = $row['postTitle'];
            $page_title = "SearchValueIs=".$_GET['search'];
        }
        else{
            $page_title = "search page is not found";
        }
        break;
    case "single.php":
        // echo "Single page";
        if(isset($_GET['id'])){
            $sql = " SELECT * from post_table where postId  = {$_GET['id']} ";
            $sql_result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($sql_result);
            $page_title = $row['postTitle'];
        }
        else{
            $page_title = "post page is not found";
        }
        break;
    default:
        // echo "News Site";

        $page_title = $logo_img['websiteName'];
        break;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="./png-transparent-news-graphy-logo-icon-news-logo-text-photography-computer-wallpaper.png" type="image/x-icon">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img width="200px" height="100px" src="admin/images/<?php echo $logo_img['logo'];?>"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>
                        <li><a href='index.php'>HOME</a></li>
                        <?php
                        $select_category = " SELECT * from category where categoryPost>0 order by categoryName asc ";
                        $select_category_q = mysqli_query($connect, $select_category);
                        if (mysqli_num_rows($select_category_q) > 0) {
                            while ($row = mysqli_fetch_assoc($select_category_q)) {
                        ?>
                                <li><a href='category.php?id=<?php echo $row['categoryId']; ?>'><?php echo $row['categoryName'] . " (" . $row['categoryPost'] . ")"; ?></a></li>
                        <?php
                            }
                        }
                        ?>
                        <!-- <li><a href='category.php'>Business</a></li>
                    <li><a href='category.php'>Entertainment</a></li>
                    <li><a href='category.php'>Sports</a></li>
                    <li><a href='category.php'>Politics</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->