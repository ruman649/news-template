<?php include "header.php";
include_once 'config.php';

if($_SESSION['userRole']==0){
    header("location: $root/admin/post.php");
}


if(isset($_POST['submit'])){
    $id = mysqli_real_escape_string($connect, $_POST['user_id']);
    $firstName = mysqli_real_escape_string($connect, $_POST['f_name']);
    $lastName = mysqli_real_escape_string($connect, $_POST['l_name']);
    $userName = mysqli_real_escape_string($connect, $_POST['username']);
    $role = mysqli_real_escape_string($connect, $_POST['role']);

    $update = " update user_table set firstName='$firstName', lastName='$lastName', userName='$userName', userRole='$role' where user_id=$id ";
    $update_query = mysqli_query($connect, $update);
    if($update_query){
        header("location: $root/admin/users.php");
    }
    else{
        echo "not valid";
    }

}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $select_from_db = " select * from user_table where user_id=$id ";
                    $select_db_query = mysqli_query($connect, $select_from_db);

                    if (mysqli_num_rows($select_db_query) > 0) {
                        $row = mysqli_fetch_assoc($select_db_query);
                ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $row['firstName']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $row['lastName']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['userName']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role">
                                    <?php 
                                        if($row['userRole']==1){
                                           echo '<option value="0">normal User</option>
                                                 <option selected value="1">Admin</option>';
                                        }
                                        else{
                                            echo '
                                            <option selected value="0">normal User</option>
                                            <option value="1">Admin</option>
                                            ';
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                        <!-- /Form -->
                <?php
                    }
                } 
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>