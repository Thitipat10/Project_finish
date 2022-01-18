<title>รายการคำสั่งซื้อ</title>

<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php
$id = $_SESSION['id'];
$sql = "SELECT * FROM tb_orders  WHERE id_user = $id AND status =5  ORDER BY OrderID DESC ";
$query = mysqli_query($connection, $sql);
$res2 = mysqli_num_rows($query);

?>
<div>
    <style>
        .received {
            color: #f43818;
            border-bottom: 5px solid #f43818;
        }
    </style>
    <?php if ($res2 == 0) { ?>
        <div class="bg-outorder">
            <div class="item2">
                <img src="https://smartsolutioncomputer.com/upload-img/Test/SV009.png" alt="" width="150" height="150">
                <div class="mt-2 mx-3">
                    ยังไม่มีการสั่งซื้อ
                </div>
            </div>

        </div>
    <?php } ?>

    <?php

    $total = 0;
    $totalsum = 0;
    ?>
    <?php foreach ($query as $key => $item) { ?>
        <?php
        $sqldetail =
            "SELECT * FROM tb_orders_detail as d 
                        INNER JOIN tb_product as p ON d.ProductID = p.id_product 
                        INNER JOIN tb_orders as o ON d.OrderID = o.OrderID
                        INNER JOIN tb_payment_orders as paym ON o.OrderID = paym.id_order
                        WHERE d.OrderID = '" . $item['OrderID'] . "' ";
        $query2 = mysqli_query($connection, $sqldetail);
        $result2 = mysqli_fetch_assoc($query2);
        ?>
        <div class="shadow-sm p-2 my-3">
            <div>
                <label class="p-1 mx-3">รหัสคำสั่งซื้อ :&nbsp;<?php echo $item['OrderID']; ?> &nbsp; วันที่สั่งซื้อ :&nbsp;<?php echo $item['OrderDate']; ?>&nbsp;
                    <?php if ($item['status'] >= 3) { ?>
                        เลขที่พัสดุ :
                        <?php echo $item['parcel_number']; ?>
                    <?php } ?></label>
                <label class="float-end mx-3"> สถานะ : &nbsp;

                    <?php
                    if ($item['status'] == 1) { ?>
                        <label class="float-end badge bg-warning mt-1">&nbsp;รอชำระเงิน</label>
                    <?php  }  ?>
                    <?php
                    if ($item['status'] == 2) { ?>
                        <label class="float-end badge bg-success mt-1">&nbsp;รอตรวจสอบการชำระเงิน</label>
                    <?php  }  ?>
                    <?php
                    if ($item['status'] == 4) { ?>
                        <label class="float-end badge bg-danger mt-1">&nbsp;ชำระเงินผิดพลาด</label>
                    <?php  }  ?>
                    <?php
                    if ($item['status'] == 5) { ?>
                        <label class="float-end badge bg-success mt-1">&nbsp;กำลังจัดส่ง</label>
                    <?php  }  ?>

                </label>

                <hr class="mx-3">


                <?php
                $delivery_Pirce = 0;
                foreach ($query2 as $item2) { ?>
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

                    <?php $delivery_Pirce += $item2['price'] * $item2['Qty'] ?>
                <?php } ?>

                <hr class="mx-3">

                <div class="row">

                    <div class="col-2">
                        <?php if ($item['status'] == 5) { ?>
                            <form action="user_order_update.php" method="POST">
                                <div class="mx-2"> <button class="pt-2 btn btn-outline-success">ได้รับสินค้าแล้ว</button></div>
                                <input type="hidden" name="received" value="6">
                                <input type="hidden" name="OrderID" value="<?php echo $item['OrderID'] ?>">
                            </form>
                        <?php } ?>
                    </div>
                    <div class=" col-9">
                        <label class=" float-end ">ค่าส่ง :&nbsp;</label>
                        <br>
                        <label class=" float-end pt-2">ยอดคำสั่งซื้อทั้งหมด :&nbsp;</label>


                    </div>
                    <div class="col-1">
                        <label class=" float-end mx-2 pb-2">&#3647;<?php echo number_format($item2['price_pm'] - $delivery_Pirce); ?></label>
                        <br>
                        <label class="text-all float-end mx-2 pb-2">&#3647;<?php echo number_format($item2['price_pm']); ?></label>
                    </div>
                </div>

                <?php
                // $_SESSION['date'] =  $item2['date'];
                // $_SESSION['time'] =  $item2['time'];

                ?>


            </div>
        </div>
    <?php } ?>
</div>