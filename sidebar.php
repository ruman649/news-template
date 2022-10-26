<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->

    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>

        <?php
        include_once 'config.php';

        $select = " SELECT * from post_table
            left join category on post_table.postCategory=category.categoryId
            left join user_table on post_table.autor=user_table.user_id
            order by postId desc limit 5";
        $select_q = mysqli_query($connect, $select);
        
        if (mysqli_num_rows($select_q) > 0) {
            while ($row = mysqli_fetch_assoc($select_q)) {
        ?>
                <div class="recent-post">
                    <a class="post-img" href="single.php?id=<?php echo $row['postId'];?>">
                        <img src="admin/upload/<?php echo $row['postImg'];?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?id=<?php echo $row['postId'];?>"><?php echo $row['postTitle'];?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?id=<?php echo $row['postCategory'];?>'><?php echo $row['categoryName'];?></a>
                        </span>
                        <span>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <a href='author.php?id=<?php echo $row['autor'];?>'><?php echo $row['userName'];?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row['postDate'];?>
                        </span>
                        <a class="read-more" href="single.php?id=<?php echo $row['postId'];?>">read more</a>
                    </div>
                </div>
        <?php
                
            }
        } else {
            echo "post is not available";
        }
        ?>



    </div>
    <!-- /recent posts box -->
</div>