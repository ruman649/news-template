<?php include 'header.php';
include_once 'config.php';

session_start();

if (isset($_GET['search'])) {
    $_SESSION['search'] = $_GET['search'];
    $search = $_SESSION['search'];
} else {
    $search = $_SESSION['search'];
}
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                $limit = 3;
                if (isset($_GET['page']) and ($_GET['page'] > 0) and (is_numeric($_GET['page']) == 1)) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
                $select = " SELECT * from post_table 
        left join category on post_table.postCategory=category.categoryid
        left join user_table on post_table.autor=user_table.user_id
        where postTitle like '%$search%' order by postId desc limit $offset, $limit";

                $select_q = mysqli_query($connect, $select);
                $count = mysqli_num_rows($select_q);
                ?>
                <div class="post-container">
                    <h2 class="page-heading">Search : <?php echo $search; ?></h2>
                    <?php
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($select_q)) {
                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['postId']; ?>"><img src="admin/upload/<?php echo $row['postImg']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['postId']; ?>'><?php echo $row['postTitle']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href="category.php?id=<?php echo $row['postCategory']; ?>"><?php echo $row['categoryName']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?id=<?php echo $row['user_id']; ?>'><?php echo $row['userName']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['postDate']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['postDesc'], 0, 150) . "..."; ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['postId']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <ul class='pagination'>
                        <?php
                        if ($page > 1) {
                        ?>
                            <li><a href="search.php?page=<?php echo $page - 1; ?>">Prev</a></li>
                            <?php
                        }
                        $select_Pagi = " select * from post_table where postTitle like '%$search%' ";
                        $select_pagi_q = mysqli_query($connect, $select_Pagi);
                        $postCount = mysqli_num_rows($select_pagi_q);
                        if ($postCount > 0) {
                            $total_page = ceil($postCount / $limit);
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($page == $i) {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                            ?>
                                <li class="<?php echo $active; ?>"><a href="search.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                            }
                            if ($total_page > $page) {
                                ?>
                                <li><a href="search.php?page=<?php echo $page + 1; ?>">Next</a></li>
                                <?php
                            }
                        }
                        ?>

                        <!-- <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li> -->
                    </ul>

                </div><!-- /post-container -->




            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>