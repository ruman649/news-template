<?php include 'header.php';

include_once "config.php";

?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                if (isset($_GET['id']) and (is_numeric($_GET['id'])==1)) {
                    $id = $_GET['id'];

                    $select = " SELECT * from post_table
                    left join category on post_table.postCategory=category.categoryId
                    left join user_table on post_table.autor=user_table.user_id where postId=$id ";

                    $select_q = mysqli_query($connect, $select);
                    if (mysqli_num_rows($select_q) > 0) {
                        $row = mysqli_fetch_assoc($select_q);
                ?>
                        <div class="post-container">
                            <div class="post-content single-post">
                                <h3><?php echo $row['postTitle']; ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <!-- <?php echo $row['categoryName']; ?> -->
                                        <a href='category.php?id=<?php echo $row['categoryId']; ?>'><?php echo $row['categoryName']; ?></a>
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
                                <img class="single-feature-image" src="admin/upload/<?php echo $row['postImg']; ?>" alt="" />
                                <p class="description">
                                   <?php echo $row['postDesc']; ?>
                                </p>
                            </div>
                        </div>

                <?php
                    } else {
                        echo "<h1 style='color:red;''>Your Giver ID is not match</h1>";
                    }
                }
                else{
                    echo "<h1 style='color:red;''>Your Giver ID is not numeric</h1>";
                }
                ?>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>