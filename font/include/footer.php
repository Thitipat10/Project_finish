<?php require_once('connection/connection.php'); ?>

<?php

$sqlpay = "SELECT * FROM tb_payment";
$querypay = mysqli_query($connection, $sqlpay);
$result = mysqli_fetch_assoc($querypay);


?>
<div class="bg-footer pt-2 mt-5 ">
    <div class="container">
        <div class="row ">
            <div class="col-2">
                Sira-on Shop
            </div>
            <div class="col-2">
                ช่วยเหลือและสนับสนุน
                <div class="mt-2">
                    <a href="delivery_information.php" class="text-white"> การจัดส่ง</a>
                    <br>
                    <a href="Howtoorder.php" class="text-white">การสั่งซื้อสินค้า</a>
<!-- 
                    <br>
                    วิธีติดตามสถานะสินค้า
                    <br>
                    คู่มือไซส์ -->
                </div>

            </div>
            <div class="col-2">
                บริการด้วยตนเอง
                <div class="mt-2 text-danger">
                    <a href="about.php" class="text-white"> ติดต่อเรา</a>
                    <br>
                    <!-- การชำระเงิน -->
                </div>

            </div>

            <div class="col-4">
                วิธีการชำระเงิน
                <div class="mt-2">
                    <?php foreach ($querypay as $row) { ?>
                        <label class="px-2"> <img src="../admin/upload/payment/<?php echo $row['image'] ?>" alt="" width="50" hight="50" class=""></img></label>
                    <?php } ?>
                </div>
            </div>
            <div class="col-2" >
                บริการจัดส่ง
                <div class="mt-2">
                    <label class="px-2"> <img src="https://inwfile.com/s-cd/3j5xhm.jpg" alt="" width="150" hight="50" class=""></img></label>
                </div>

            </div>
        </div>
    </div>

</div>