<?php
include "header.php";
include_once 'config.php';

if($_SESSION['userRole']==0){
    header("location: $root/admin/post.php");
}
if(isset($_POST['save'])){
    $cat = mysqli_real_escape_string($connect, $_POST['cat']);
    
    $select_db = " select * from category where categoryName='$cat' ";
    $select_db_q = mysqli_query($connect, $select_db);

    if(mysqli_num_rows($select_db_q) > 0){
        echo "This category is already exist";
    }
    else{
        $insert = " insert into category(categoryName) values ('$cat') ";
        $insert_q = mysqli_query($connect, $insert);
        if($insert_q){
            header('location: http://localhost:3000/admin/category.php');
        }
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
