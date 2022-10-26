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
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 3;
                        if (isset($_GET['page']) and $_GET['page'] >= 1) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $offset = ($page - 1) * $limit;

                        $select_from_db = " select * from user_table order by user_id desc limit $offset, $limit";
                        $select_db_query = mysqli_query($connect, $select_from_db);

                        if (mysqli_num_rows($select_db_query) > 0) {

                            $serial = 1;
                            while ($row = mysqli_fetch_assoc($select_db_query)) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo $serial++; ?></td>
                                    <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                                    <td><?php echo $row['userName']; ?></td>
                                    <td><?php if ($row['userRole'] == 1) {
                                            echo 'Admin';
                                        } else {
                                            echo 'User';
                                        } ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo "<h2 style='color:red; '>zero user is found</h2>";
                        }
                        ?>

                    </tbody>
                </table>

                <ul class='pagination admin-pagination'>
                    <?php
                    if ($page > 1) {
                    ?>
                        <li><a href="users.php?page=<?php echo $page-1; ?>">Prev</a></li>
                    <?php
                    }
                    ?>
                    <?php
                    $select_for_pagi = " select * from user_table ";
                    $select_for_pagi_q = mysqli_query($connect, $select_for_pagi);
                    $total_page=0;
                    if (mysqli_num_rows($select_for_pagi_q) > 0) {
                        $total_post = mysqli_num_rows($select_for_pagi_q);
                        // $limit = 3; //its define in select query at first
                        $total_page = ceil($total_post / $limit);
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                    ?>
                            <li class="<?php echo $active; ?>"><a href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                    <?php
                        }
                    }
                    ?>
                    <?php
                    if ($total_page > $page) {
                    ?>
                        <li><a href="users.php?page=<?php echo $page+1; ?>">Next</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>