<?php include "header.php";


include_once 'config.php';
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 3;
                        if (isset($_GET['page']) and ($_GET['page'] > 0) and is_numeric($_GET['page'])==1) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;

                        $select = "SELECT * from post_table 
                            left join category on post_table.postCategory=category.categoryId
                            left join user_table on post_table.autor=user_table.user_id
                            order by postId desc limit $offset, $limit";
                        // $select = "select * from post_table 
                        // right join user_table on post_table.autor=user_table.user_id
                        // ";
                        $select_q = mysqli_query($connect, $select) or die('select query fail');
                        if (mysqli_num_rows($select_q) > 0) {
                            while ($row = mysqli_fetch_assoc($select_q)) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo  $offset+1; ?></td>
                                    <td><?php echo $row['postTitle']; ?></td>
                                    <td><?php echo $row['categoryName']; ?></td>
                                    <td><?php echo $row['postDate']; ?></td>
                                    <td><?php echo $row['userName']; ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $row['postId']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $row['postId']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                        $offset++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php
                    if($page>1){
                        ?>
                        <li><a href="post.php?page=<?php echo $page-1; ?>">Prev</a></li>
                        <?php
                    }
                    // $limit = 3;
                    $select_for_pagenation = " select * from post_table ";
                    $total_page = 0;
                    $select_for_pagenation_q = mysqli_query($connect, $select_for_pagenation) or die("pagination query is fail");
                    if (mysqli_num_rows($select_for_pagenation_q) > 0) {
                        $total_post = mysqli_num_rows($select_for_pagenation_q);
                        $total_page = ceil($total_post / $limit);
                        for ($i = 1; $i <= $total_page; $i++) {
                            if($page==$i){
                                $active = "active";
                            }
                            else{
                                $active = '';
                            }
                    ?>
                            <li class="<?php echo $active; ?>"><a href="post.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                    }
                    if ($page < $total_page) {
                        ?>
                        <li><a href="post.php?page=<?php echo $page+1; ?>">Next</a></li>
                    <?php
                    }
                    ?>

                    <!-- <li class="active"><a>1</a></li>
                    <li><a>2</a></li>-->
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>