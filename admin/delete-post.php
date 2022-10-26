<?php
include_once 'config.php';
session_start();

if (!isset($_GET['id'])) {
    header("location: $root/admin/post.php?id=isNotMatch");
} else if (isset($_GET['id'])) {
    $collectUserRole = "SELECT * from post_table
    left join user_Table on post_Table.autor = user_Table.user_id
    where postId={$_GET['id']} ";
    $collectUserRole_q = mysqli_query($connect, $collectUserRole);
    $userRole_row = mysqli_fetch_assoc($collectUserRole_q);

    if (($userRole_row['userRole'] != $_SESSION['userRole']) and ($_SESSION['userRole'] != 1)) {
        header("location: $root/admin/post.php?edit=onlyAdminCanDelete");
        // echo "noly admin can edit this post";
        die();
    } else {
        $id = $_GET['id'];

        $select = " select * from post_table where postId=$id ";
        $select_q = mysqli_query($connect, $select);
        $row = mysqli_fetch_assoc($select_q);

        unlink("upload/" . $row['postImg']);

        // echo "<pre>";
        // print_r($row);
        // die();

        $category_id = $row['postCategory'];
        $delete = " update category set categoryPost=categoryPost-1 where categoryId=$category_id ;";
        $delete .= " delete from post_table where postId=$id ";
        $delete_q = mysqli_multi_query($connect, $delete);

        if ($delete_q) {
            header("location: $root/admin/post.php?delete=success");
        } else {
            header("lcoation: $root/admin/post.php?delete=fail");
        }
    }
}
