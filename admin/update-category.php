<?php include "header.php";
include_once 'config.php';

if($_SESSION['userRole']==0){
    header("location: $root/admin/post.php");
}
if(isset($_POST['submit'])){
    $cid = $_POST['categoryId'];
    $name = mysqli_real_escape_string($connect,$_POST['name']);

    $insert = " update category set categoryName='$name' where categoryId=$cid " ;
    $insert_q = mysqli_query($connect, $insert);
    if($insert_q){
        header("location: http://localhost:3000/admin/category.php");
    }
    else{
        echo "some problem occurs";
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $select = " select * from category where categoryId=$id ";
                    $select_q = mysqli_query($connect, $select);

                    if (mysqli_num_rows($select_q) == 1) {
                        $row = mysqli_fetch_assoc($select_q);
                ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="categoryId" value="<?php echo $row['categoryId']; ?>" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $row['categoryName']; ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>

                <?php
                    } else {
                        echo "<h1 style='color:red; '>ID is not match</h1>";
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>