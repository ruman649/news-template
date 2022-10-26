<?php include 'header.php';
include_once 'config.php';
session_start();

?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                $arr = array();
                // if (isset($_GET['id']) and (is_numeric($_GET['id']) == 1)) {
                    if(isset($_GET['id']) and (is_numeric($_GET['id']) == 1) ){
                        $_SESSION['authorName'] = $_GET['id'];
                        $id = $_SESSION['authorName'];
                    }
                    else{
                        // $_SESSION['authorName'] = $_GET['id'];
                        $id = $_SESSION['authorName'];
                    }
                    
                    $select_author = " select userName from user_table where user_id=$id ";
                    $select_author_q = mysqli_query($connect, $select_author);
                    if (mysqli_num_rows($select_author_q) == 1) {
                        $row = mysqli_fetch_assoc($select_author_q);
                ?>
                        <!-- post-container -->
                        <div class="post-container">
                            <h2 class="page-heading"><?php echo $row['userName']; ?></h2>

                            <?php
                            $limit = 3;
                            if(isset($_GET['page']) and ($_GET['page'] > 0) and (is_numeric($_GET['page'])==1)){
                                $page = $_GET['page'];
                            }
                            else{
                                $page = 1;
                            }
                            $offset = ($page - 1) * $limit;

                            $select_all = " SELECT * from post_table
                                 left join category on post_table.postCategory=category.categoryId where autor=$id order by postId desc limit $offset, $limit ";
                            $select_all_q = mysqli_query($connect, $select_all);

                            if (mysqli_num_rows($select_all_q) > 0) {
                                while ($row1 = mysqli_fetch_assoc($select_all_q)) {
                            ?>

                                    <div class="post-content">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a class="post-img" href="single.php?id=<?php echo $row1['postId']; ?>"><img src="admin/upload/<?php echo $row1['postImg']; ?>" alt="" /></a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="inner-content clearfix">
                                                    <h3><a href="single.php?id=<?php echo $row1['postId']; ?>"><?php echo $row1['postTitle']; ?></a></h3>
                                                    <div class="post-information">
                                                        <span>
                                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                                            <a href='category.php?id=<?php echo $row1['postCategory'];?>'><?php echo $row1['categoryName']; ?></a>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                            <a href=''><?php echo $row['userName']; ?></a>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            <?php echo $row1['postDate']; ?>
                                                        </span>
                                                    </div>
                                                    <p class="description">
                                                        <?php echo substr($row1['postDesc'], 0, 150); ?>
                                                    </p>
                                                    <a class='read-more pull-right' href="single.php?id=<?php echo $row1['postId']; ?>">read more</a>
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
                                if($page > 1 ){
                                    ?>
                                    <li><a href="author.php?page=<?php echo $page-1; ?>">Prev</a></li>
                                    <?php
                                }
                                // $limit = 3;
                                    $select_pagi = " select * from post_table where autor=$id ";
                                    $select_pagi_q = mysqli_query($connect, $select_pagi);
                                    if(mysqli_num_rows($select_pagi_q) > 0){
                                        $total_post = mysqli_num_rows($select_pagi_q);
                                        $total_page= ceil($total_post / $limit);
                                        for($i = 1; $i<=$total_page; $i++){
                                            if($page==$i){
                                                $active = 'active';
                                            }
                                            else{
                                                $active = '';
                                            }
                                            ?>
                                                <li class="<?php echo $active; ?>"><a href="author.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            <?php
                                        }
                                        if($total_page > $page){
                                            ?>
                                            <li><a href="author.php?page=<?php echo $page+1; ?>">Next</a></li>
                                            <?php
                                        }
                                    }
                                ?>
                                <!-- <li class="active"><a href="">1</a></li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li> -->
                            </ul>
                        </div>
                        <!-- /post-container -->
                <?php
                    }
                // } else {
                //     echo "id is not match";
                // }

                ?>

            </div>

            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>