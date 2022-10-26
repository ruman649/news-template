<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                include_once 'config.php';
                $select_setting = " select * from setting ";
                $select_setting_q = mysqli_query($connect, $select_setting);
                $row = mysqli_fetch_assoc($select_setting_q);
                ?>

                <span><?php echo $row['footerDesc'];?></a></span>

            </div>
        </div>
    </div>
</div>
</body>

</html>