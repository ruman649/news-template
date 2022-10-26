<?php
include_once 'header.php';
include_once 'config.php';

if (isset($_POST['submit'])) {
    $logoName = $_FILES['logo']['name'];
    $logoTmp = $_FILES['logo']['tmp_name'];
    $logoSize = $_FILES['logo']['size'];
    $logoError = $_FILES['logo']['error'];

    if ($logoError == 0) {
        if ($logoSize < 2097152) {
            $expl = explode(".", $logoName);
            $exten = strtolower(end($expl));
            $arr = ['jpg', 'jpeg', 'png'];
            if (in_array($exten, $arr) == 1) {
                $select_img = " select * from setting ";
                $select_img_q = mysqli_query($connect, $select_img);
                if (mysqli_num_rows($select_img_q) > 0) {
                    $row1 = mysqli_fetch_assoc($select_img_q);
                    unlink("images/" . $row1['logo']);
                }

                move_uploaded_file($logoTmp, "images/" . $logoName);
                $img_up = " update setting set logo='$logoName' ";
                $img_up_q = mysqli_query($connect, $img_up);
            }
        }
    }
    $siteName = mysqli_real_escape_string($connect, $_POST['websiteName']);
    $siteFooter = mysqli_real_escape_string($connect, $_POST['footerDesc']);
    $upload = " update setting set websiteName='$siteName', footerDesc='$siteFooter' ";
    $upload_q = mysqli_query($connect, $upload);
    if ($upload_q) {
        header("location: $root/admin/post.php");
    } else {
        die("something went wrong");
    }
}


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Setting</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <?php
                    $select = " select * from setting ";
                    $select_q = mysqli_query($connect, $select);
                    $row = mysqli_fetch_assoc($select_q);
                    // echo $row['websiteName'];

                    ?>
                    <div class="form-group">
                        <label for="post_title">Website Name</label>
                        <input type="text" name="websiteName" class="form-control" value="<?php
                                                                                            if (isset($row['websiteName'])) {
                                                                                                echo  $row['websiteName'];
                                                                                            }
                                                                                            ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Footer Description</label>
                        <textarea name="footerDesc" class="form-control" rows="5"><?php
                                                                                    if (isset($row['footerDesc']))
                                                                                        echo $row['footerDesc'];
                                                                                    ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Website Logo</label>
                        <input type="file" name="logo">
                        <img width="200px" height="100px" src="./images/<?php
                            if(isset($row['logo'])){
                                echo $row['logo'];
                            }
                         ?>" alt="">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>

<?php
include_once 'footer.php';
?>