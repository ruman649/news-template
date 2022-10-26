<?php include "header.php";
include_once 'config.php';

if($_SESSION['userRole']==0){
    header("location: $root/admin/post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_GET['page']) and $_GET['page'] > 1) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $limit = 3;
                        $offset = ($page - 1) * $limit;

                        $select = " select * from category order by categoryName asc limit $offset, $limit";
                        $select_q = mysqli_query($connect, $select);

                        if (mysqli_num_rows($select_q) > 0) {
                            while ($row = mysqli_fetch_assoc($select_q)) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo $row['categoryId']; ?></td>
                                    <td><?php echo $row['categoryName']; ?></td>
                                    <td><?php echo $row['categoryPost']; ?></td>
                                    <td class='edit'><a href='update-category.php?id=<?php echo $row['categoryId']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?id=<?php echo $row['categoryId']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            }
                        }
                        else{
                            echo "<h1 style='color:red';> page not found </h1>";
                        }
                        ?>

                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php
                    if ($page > 1) {
                    ?>
                        <li><a href="category.php?page=<?php echo $page - 1; ?>">Prev</a></li>
                    <?php
                    }
                    ?>

                    <?php
                    $select_for_pagi = " select * from category ";
                    $select_for_pagi_q = mysqli_query($connect, $select_for_pagi);
                    $total_category = mysqli_num_rows($select_for_pagi_q);
                    $total_page = ceil($total_category / $limit);

                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                    ?>
                        <li class="<?php echo $active; ?>"><a href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php

                    }

                    ?>

                    <?php
                    if ($total_page > $page) {
                    ?>
                        <li><a href="category.php?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>