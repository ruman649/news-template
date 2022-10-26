<?php 
include "header.php"; 
include_once 'config.php';

if($_SESSION['userRole']==0){
    header("location: $root/admin/post.php");
}
if(isset($_POST['save'])){

    $firstName = mysqli_real_escape_string($connect, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($connect, $_POST['lastName']);
    $userName = mysqli_real_escape_string($connect, $_POST['userName']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $role = mysqli_real_escape_string($connect, $_POST['role']);

    $select_from_db = " select userName from  user_table where userName='$userName' " ;
    $select_from_db_query = mysqli_query($connect, $select_from_db);

    if(mysqli_num_rows($select_from_db_query) > 0){
        echo "user name is already exist";
    }
    else{
        $password = password_hash($password, PASSWORD_BCRYPT);

        $insert_db = " insert into user_table (firstName, lastName,userName,userPass, userRole) values ('$firstName', '$lastName', '$userName', '$password', $role) ";
        $insert_db_query = mysqli_query($connect, $insert_db);
        if($insert_db_query){
            header("location: $root/admin/users.php");
        }
        else{
            echo "something went wrong";
        }
    }

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="userName" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
