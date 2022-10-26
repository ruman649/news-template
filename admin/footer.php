<!-- Footer -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $select_setting = " select * from setting ";
                $select_setting_q = mysqli_query($connect, $select_setting);
                $row = mysqli_fetch_array($select_setting_q);
                ?>
                <span><?php echo $row['footerDesc'];?><a href=""></a></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>

</html>