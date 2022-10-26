<?php include 'header.php';
include_once 'config.php';
session_start();

if (isset($_GET['id']) and ($_GET['id'] > 0) and (is_numeric($_GET['id']))) {
    $_SESSION['category_id'] = $_GET['id'];
    $cateId = $_SESSION['category_id'];
} else {
    $cateId = $_SESSION['category_id'];
}
$select_category = " select * from category where categoryId=$cateId ";
$select_category_q = mysqli_query($connect, $select_category);
if (mysqli_num_rows($select_category_q) != 1) {
    echo "<h1 style='color:red;'>Sorry Your request category is not exist anymore...</h1>";
    die();
}
$row = mysqli_fetch_assoc($select_category_q);
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <h2 class="page-heading"><?php echo "<b style='color:green;'>" . strtoupper($row['categoryName']) . "</b> total post = " . $row['categoryPost']; ?></h2>
                    <?php
                    $limit = 3;
                    if (isset($_GET['page']) and ($_GET['page'] > 0) and (is_numeric($_GET['page']) == 1)) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    $select_post = " SELECT * from post_table
                        left join category on post_table.postCategory=category.categoryId
                        left join user_table on post_table.autor=user_table.user_id where postCategory=$cateId order by postId desc limit $offset, $limit ";

                    $select_post_q = mysqli_query($connect, $select_post);
                    if (mysqli_num_rows($select_post_q) > 0) {
                        while ($row1 = mysqli_fetch_assoc($select_post_q)) {
                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row1['postId']; ?>"><img src="admin/upload/<?php echo $row1['postImg']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row1['postId']; ?>'><?php echo $row1['postTitle']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href=''><?php echo $row1['categoryName']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?id=<?php echo $row1['user_id']; ?>'><?php echo $row1['userName']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row1['postDate']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row1['postDesc'], 0, 150) . "..." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row1['postId']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<h1 style='color:red;'>Sorry zero post is found...</h1>";
                    }
                    ?>
                    <ul class='pagination'>
                        <?php
                        if($page>1){
                            ?>
                            <li><a href="category.php?page=<?php echo $page -1; ?>">Prev</a></li>
                            <?php
                        }
                        // $limit = 3;
                        $select_pegi = " select * from post_table where postCategory=$cateId ";
                        $select_pegi_q = mysqli_query($connect, $select_pegi);


                        if (mysqli_num_rows($select_pegi_q) > 0) {
                            $total_post = mysqli_num_rows($select_pegi_q);
                            $total_page = ceil($total_post / $limit);
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($page == $i) {
                                    $active = "active";
                                } else {
                                    $active = '';
                                }
                        ?>
                                <li class="<?php echo $active; ?>"><a href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                            <?php
                            }
                            if ($total_page > $page) {
                            ?>
                                <li><a href="category.php?page=<?php echo $page + 1; ?>">Next</a></li>
                             <?php
                            }
                        } else {
                            echo "no";
                        }
                        ?>
                        <!-- <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li> -->
                    </ul>

                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>