<?php include "header.php";
include_once 'config.php';
// session_start();

if (isset($_POST['submit'])) {

    if (empty($_FILES['new-image']['name'])) {
        $name = $_POST['old-image'];
    } else {
        $name = $_FILES['new-image']['name'];
        $tmp = $_FILES['new-image']['tmp_name'];
        $size = $_FILES['new-image']['size'];
        $type = $_FILES['new-image']['type'];

        $arr = explode('.', $name);
        $arr = strtolower(end($arr));

        // echo "<pre>";
        // print_r($arr);
        $container = array('jpeg', 'jpg', 'png');
        $error = array();
        if (in_array($arr, $container) == 0) {
            $error[] = 'You should upload jpeg, jpg, png file only';
        }
        if ($size > 2097152) {
            $error[] = 'your image size is too much large';
        }
        if (empty($error)) {
            move_uploaded_file($tmp, "upload/" . $name);
        } else {
            for ($i = 0; $i <= count($error); $i++) {
                echo $error[$i] . "<br>";
            }
            die('fixed the errors');
        }
    } //end the files upload

    $post_id = $_POST['post-id'];
    $post_title = mysqli_real_escape_string($connect, $_POST['post_title']);
    $postdesc = mysqli_real_escape_string($connect, $_POST['postdesc']);
    $postdesc = trim($postdesc);
    $categoryId = mysqli_real_escape_string($connect, $_POST['category']);
    $old_category_id = $_POST['old_category_id'];

    $update = " update post_table set postTitle='$post_title', postDesc='$postdesc', postCategory=$categoryId, postImg='$name' where postId=$post_id ;";
    $update .= " update category set categoryPost=categoryPost+1 where categoryId=$categoryId ;";
    $update .= " update category set categoryPost=categoryPost-1 where categoryId = $old_category_id ;";

    $update_q = mysqli_multi_query($connect, $update);
    if ($update_q) {
        header("location: $root/admin/post.php?update=success");
    } else {
        header("location: $root/admin/update-post.php?update=notSuccess");
    }
}


if (!isset($_GET['id'])) {
    header("location: $root/admin/post.php?id=isNotMatch");
}
else if(isset($_GET['id'])){
    $collectUserRole = "SELECT * from post_table
    left join user_Table on post_Table.autor = user_Table.user_id
    where postId={$_GET['id']} ";
    $collectUserRole_q = mysqli_query($connect, $collectUserRole);
    $userRole_row = mysqli_fetch_assoc($collectUserRole_q);
    
    if($userRole_row['userRole']!=$_SESSION['userRole'] and ($_SESSION['userRole']!=1)){
        header("location: $root/admin/post.php?edit=onlyAdminCanEditAdminPost");
        // echo "noly admin can edit this post";
        // die();
    }
    
}



?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $id = $_GET['id'];
                $selectFromPost = " select * from post_table where postId=$id ";
                $selectFromPost_q = mysqli_query($connect, $selectFromPost);
                if (mysqli_num_rows($selectFromPost_q) == 1) {
                    $row = mysqli_fetch_assoc($selectFromPost_q);
                } else {
                    header("location: $root/admin/post.php?id=notvalid");
                }
                ?>
                <!-- Form for show edit-->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="post-id" class="form-control" value="<?php echo $row['postId']; ?>" placeholder="">
                        <input type="hidden" name="old_category_id" class="form-control" value="<?php echo $row['postCategory']; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['postTitle']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" required rows="5">
                <?php echo $row['postDesc']; ?>
                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category">
                            <option disabled value="">select</option>
                            <?php
                            // $categoryId = $row['categoryId'];
                            $selectFromCategory = " select * from category  ";
                            $selectFromCategory_q = mysqli_query($connect, $selectFromCategory);
                            $old_category_id = '';
                            if (mysqli_num_rows($selectFromCategory_q) > 0) {
                                while ($row1 = mysqli_fetch_assoc($selectFromCategory_q)) {
                                    if ($row['postCategory'] == $row1['categoryId']) {
                                        $active = 'selected';
                                    } else {
                                        $active = '';
                                    }
                            ?>
                                    <option <?php echo $active; ?> value="<?php echo $row1['categoryId']; ?>"><?php echo $row1['categoryName']; ?></option>

                            <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new-image">
                        <img src="upload/<?php echo $row['postImg']; ?>" height="150px">
                        <input type="hidden" name="old-image" value="<?php echo $row['postImg']; ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>

</div>
<?php include "footer.php"; ?>