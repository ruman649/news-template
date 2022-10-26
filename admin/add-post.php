<?php include "header.php";
include_once 'config.php';


if(isset($_POST['submit'])){
    $random = rand(54321, 99999);
    if(isset($_FILES['fileToUpload'])){
        $error = array();

        $name = $_FILES['fileToUpload']['name'];
        $tmp = $_FILES['fileToUpload']['tmp_name'];
        $size = $_FILES['fileToUpload']['size'];
        $type = $_FILES['fileToUpload']['type'];


        $d = explode(".", $name);
        // echo "<pre>";
        // print_r($d);
        $ext = strtolower(end($d));
        
      

        $ext_arr = array('jpeg','jpg','png');

        if(in_array($ext, $ext_arr)==0){
            $error[] = "you should upload jpg, jpeg, png file";
        }
        if($size > 2097152){
            $error[] = "image size is greatere then 2 MB ";
        }

        if(empty($error)){

            move_uploaded_file($tmp, "upload/".$random.$name);
        }
        else{
            for($i = 0; $i<count($error); $i++){
                echo $error[$i]."<br>";
            }
            die('file upload fail');
        }
        $name  = $random.$name;

    }
    

    $title = mysqli_real_escape_string($connect, $_POST['post_title']);
    $postdesc = mysqli_real_escape_string($connect, $_POST['postdesc']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $date = date('d M Y');
    $author = $_SESSION['userId'];

    echo $author;

    $insert_post = " insert into post_table (postTitle, postDesc, postDate,postImg,postCategory,autor ) values ('$title', '$postdesc','$date', '$name', '$category', '$author'); ";

    $insert_post .= " update category set categoryPost=categoryPost+1 where categoryId=$category ";

    $insert_q = mysqli_multi_query($connect, $insert_post) or die('query fail');

    if($insert_q){
        header("location: $root/admin/post.php");
    }
    else{
        echo "query fail to run";
    }





}



?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">

                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <option disabled> Select Category</option>
                            <?php
                            $select_category = " select * from category ";
                            $select_category_q = mysqli_query($connect, $select_category);
                            if (mysqli_num_rows($select_category_q) > 0) {
                                while ($row = mysqli_fetch_array($select_category_q)) {
                            ?>
                                    <option value="<?php echo $row['categoryId']; ?>"><?php echo $row['categoryName']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>