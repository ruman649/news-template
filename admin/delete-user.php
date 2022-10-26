<?php 
    include "config.php";
    if($_SESSION['userRole']==0){
        header("location: $root/admin/post.php");
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete = " delete from user_table where user_id=$id ";
        $delete_query = mysqli_query($connect, $delete);
        if($delete_query){
            header("location: $root/admin/users.php?delete=successful");
        }
        else{
            header("location: $root/admin/users.php?delere=notsuccessful");
        }
    }
?>