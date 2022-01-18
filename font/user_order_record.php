<title>รายการคำสั่งซื้อ</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php require_once('account.php'); ?>
<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php
$id = $_SESSION['id'];
$sql = "SELECT * FROM tb_orders  WHERE id_user = $id AND status =4  ORDER BY OrderID DESC ";
$query = mysqli_query($connection, $sql);



?>
<?php
if (isset($_POST) && !empty($_POST)) {
    // print_r($_POST);

    $status = $_POST['received'];
    $OrderID = $_POST['OrderID'];
    $user = $_SESSION['id'];


    $sqlreceived =  "UPDATE tb_orders SET status='$status'  WHERE OrderID = $OrderID AND id_user =$user ";
    $queryreceived = mysqli_query($connection, $sqlreceived);
}

?>


<div class="col-10">
    <div class="row">

        <div class="col-12 col-lg-12 my-2">
            <h3 class="app-page-title mb-4 ">ประวัติการสั่งซื้อ</h3>
            <?php

            $total = 0;
            $totalsum = 0;
            ?>
            <?php foreach ($query as $key => $item) { ?>

                <?php
                $sqldetail =
                    "SELECT * FROM tb_orders_detail as d 
                        INNER JOIN tb_product as p    ON d.ProductID = p.id_product 
                        INNER JOIN tb_payment_orders as pm  ON d.OrderID = pm.id_order
                        WHERE d.OrderID = '" . $item['OrderID'] . "' ";
                $query2 = mysqli_query($connection, $sqldetail);
                $result2 = mysqli_fetch_assoc($query2);
                ?>
                <div class="shadow-sm p-2 my-3">
                    <div>
                        <label class="p-1 mx-3">รหัสคำสั่งซื้อ :&nbsp;<?php echo $item['OrderID']; ?> &nbsp; วันที่สั่งซื้อ :&nbsp;<?php echo $result2['date']; ?>&nbsp; เวลา :&nbsp;<?php echo $result2['time']; ?>
                            <?php if ($item['status'] >= 3) { ?>
                                เลขที่พัสดุ :
                                <?php echo $item['parcel_number']; ?>
                            <?php } ?></label>
                        <label class="float-end mx-3"> สถานะ : &nbsp;

                            <?php
                            if ($item['status'] == 0) { ?>
                                <label class="float-end badge bg-warning mt-1">&nbsp;รอยืนยันการชำระเงิน</label>
                            <?php  }  ?>
                            <?php
                            if ($item['status'] == 1) { ?>
                                <label class="float-end badge bg-success mt-1">&nbsp;รอการจัดส่ง</label>
                            <?php  }  ?>
                            <?php
                            if ($item['status'] == 2) { ?>
                                <label class="float-end badge bg-danger mt-1">&nbsp;ชำระเงินผิดพลาด</label>
                            <?php  }  ?>
                            <?php
                            if ($item['status'] == 3) { ?>
                                <label class="float-end badge bg-success mt-1">&nbsp;กำลังส่ง</label>
                            <?php  }  ?>
                            <?php
                            if ($item['status'] == 4) { ?>
                                <label class="float-end badge bg-success mt-1">&nbsp;รับของแล้ว</label>
                            <?php  }  ?>

                        </label>

                        <hr class="mx-3">


                        <?php foreach ($query2 as $item2) { ?>
                            <?php

                            $sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                             WHERE tt.tb_product_id = '" . $item2['id_product'] . "'";
                            $query = mysqli_query($connection, $sql);
                            $result = mysqli_fetch_assoc($query);

                            ?>
                            <div class="row p-3">
                                <div class="col-2">

                                    <img class="" src="../admin/upload/product/<?php echo $result['image'] ?>" width="150" height="150">

                                </div>
                                <div class="col-7">
                                    <?php echo $item2['title'] ?>
                                    <div>
                                        จำนวน <?php echo $item2['Qty'] ?> ชิ้น
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="float-end">
                                        &#3647;<?php echo number_format($item2['price'] * $item2['Qty']); ?>
                                    </div>
                                </div>
                            </div>


                        <?php } ?>

                        <hr class="mx-3">

                        <div class="row">

                            <div class="col-2">
                                <?php if ($item['status'] == 3) { ?>
                                    <form action="" method="POST">
                                        <div class="mx-2"> <button class="pt-2 btn btn-outline-success">ได้รับสินค้าแล้ว</button></div>
                                        <input type="hidden" name="received" value="4">
                                        <input type="hidden" name="OrderID" value="<?php echo $item['OrderID'] ?>">
                                    </form>
                                <?php } ?>
                            </div>

                            <div class=" col-9"> <label class=" float-end pt-2">ยอดคำสั่งซื้อทั้งหมด :&nbsp;</label>
                            </div>
                            <div class="col-1"> <label class="text-all float-end mx-2 pb-2">&#3647;<?php echo number_format($item2['price_pm']); ?></label></div>
                        </div>
                        <?php
                        // $_SESSION['date'] =  $item2['date'];
                        // $_SESSION['time'] =  $item2['time'];

                        ?>


                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

</div>

</div>

</div>

<?php require_once('include/footer.php'); ?>