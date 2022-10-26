<?php
include_once 'config.php';
if($_SESSION['userRole']==0){
    header("location: $root/admin/post.php");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $delete = " delete from category where categoryId=$id ";
    $delete_q = mysqli_query($connect, $delete);

    if($delete_q){
        header('location: http://localhost:3000/admin/category.php?delete=successfull');
    }
    else{
        header('location: http://localhost:3000/admin/category.php?delete=unsuccess');
    }
}


?>