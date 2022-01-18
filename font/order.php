<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../font/assets/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php


require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php');
$sql = "SELECT  * , sum(c.qty) as SUM FROM tb_cart as c 
INNER JOIN tb_size as s ON c.tb_size_id2 = s.id_size
INNER JOIN tb_color as o ON c.tb_color_id2 = o.id_color
INNER JOIN tb_product as p ON c.productID = p.id_product
WHERE c.status = 1 AND c.user = '" . $_SESSION['id'] .  "'
GROUP BY c.productID";
$rowcart = mysqli_query($connection, $sql);
$resutl = mysqli_fetch_all($rowcart);

?>

<?php

$sqladdress = "SELECT * FROM tb_address as a
INNER JOIN province  as p ON a.province = p.ProvinceID
INNER JOIN tambon as d ON a.districts = d.TambonID
INNER JOIN district as t ON a.amphures = t.DistrictID
WHERE status = 0  AND a.user = '" . @$_SESSION['id'] .  "'";


$resultaddress = mysqli_query($connection, $sqladdress);
$resultad = mysqli_fetch_assoc($resultaddress);
// $reee = mysqli_fetch_assoc($resultaddress);


$sqlpayment = "SELECT * FROM tb_payment";
$resutlpayment = mysqli_query($connection, $sqlpayment);
$resutl1 = mysqli_fetch_assoc($resutlpayment);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<?php require_once('include/header.php'); ?>
<div class="bg-22"></div>
<div class="bg-card p-5">
    <div class="container ">
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb  float-center">
                <li class="breadcrumb-item active" aria-current="page">รถเข็น</li>
                <li class="breadcrumb-item text-type" aria-current="page">สั่งซื้อ</li>

            </ul>
        </nav>
        <div class="col-md-12 mx-auto">
            <div class="row">

                <div class="col-md-8 mx-auto mt-5">
                    <div class="card mb-3">
                        <i class="fas fa-map-marker-alt px-3 pt-3"> ที่อยู่ในการจัดส่ง</i>
                        <?php if (empty($resutlad['user'])) { ?>
                            <?php foreach ($resultaddress as $row => $item2) { ?>
                                <div class="p-3">
                                    <label class="text-type"><?php echo $item2['firstname'] ?>
                                        <?php echo $item2['lastname'] ?>
                                        <?php echo $item2['phone'] ?></label>
                                    <?php echo $item2['address_details'] ?>,
                                    เขต<?php echo $item2['DistrictName']; ?>,
                                    จังหวัด <?php echo $item2['ProvinceThai']; ?>,
                                    <?php echo $item2['zipcode']; ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if (!empty($resutlad['user'])) { ?>
                            <div>65555555555</div>
                        <?php } ?>


                    </div>
                    <div class="card p-3">
                        <table class="table" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col">ไอเทม</th>

                                    <th scope="col">ราคา</th>
                                    <th scope="col" class="text-center">จำนวน</th>
                                    <th scope="col">ยอดรวมทั้งหมด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $total = 0;
                                $total2 = 0;
                                $totalsum = 0;
                                ?>
                                <div class="pt-3">
                                    <h4>สรุปรายการ(<?php echo $_SESSION['tt']; ?>)</h4>
                                </div>

                                <?php
                                foreach ($rowcart as $row => $item) { ?>
                                    <?php
                                    $sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                             WHERE statusimage = 1 AND tt.tb_product_id = '" . $item['id_product'] . "'";
                                    $query = mysqli_query($connection, $sql);
                                    $result = mysqli_fetch_assoc($query);

                                    ?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4"><label for=""><img src="../admin/upload/product/<?php echo $result['image'] ?>" width="120" height="150"></label></div>
                                                <div class="col-md-7">
                                                    <label class="text-type"><?php echo $item['title'] ?></label>
                                                    <br>
                                                    <br>
                                                    <label class="">ไซส์ : <?php echo $item['title_size'] ?></label>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>


                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label class='text-type'>&#3647;<?php echo number_format($item['price']) ?></label>
                                        </td>
                                        <td class="text-center">

                                            <div name="qty"><?php echo $item['SUM'] ?></div>

                                        </td>
                                        <td>
                                            <label class='text-type'>&#3647;<?php echo number_format($item['SUM'] * $item['price']) ?></label>
                                        </td>

                                    </tr>


                                    <?php $total += $item['SUM'] * $item['price'] ?>
                                    <?php $_SESSION['tt'] = $totalsum += $item['SUM'] ?>

                                    <?php $total2 += ($item['price']  - $item['cost']) * $item['SUM'] ?>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4 mx-auto ">

                    <div class="card mt-5">
                        <div class="row g-0">
                            <label class="m-3">
                                <h4>สรุปใบสั่งซื้อ</h4>
                            </label>
                            <div class="col-md-5">
                                <div class="m-3">

                                    <label class="float-left"> ยอดรวมสินค้า</label>
                                    <br>
                                    <label class="float-left mt-2">การจัดส่ง</label>
                                    <br>
                                    <label class="float-left mt-4">ยอดรวมชำระทั้งหมด</label>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="m-3">

                                    <label class='text-dannger float-end'>&#3647;<?php echo number_format($total, 2) ?></label>
                                    <br>
                                    <?php
                                    if ($totalsum == 1) { ?>
                                        <label class="float-end mt-2">&#3647;50</label>
                                    <?php } ?>


                                    <?php
                                    if ($totalsum != 1) { ?>
                                        <label class="float-end mt-2"> &#3647;<?php echo $_SESSION['pr'] = ($totalsum * 10) + 50 - 10 ?>.00</label>
                                    <?php } ?>
                                    <br>
                                    <br>

                                    <?php
                                    if ($totalsum == 1) { ?>

                                        <label class="float-end mt-1">&#3647;<?php echo  $total + 50 ?></label>
                                    <?php } ?>
                                    <?php

                                    if ($totalsum != 1) { ?>
                                        <label class="float-end mt-1"> &#3647;<?php echo $total + $_SESSION['pr'] = ($totalsum * 10) + 50 - 10 ?>.00</label>
                                    <?php } ?>


                                </div>

                            </div>


                        </div>
                        <form action="insertOrder.php" method="POST" id="form_con">
                            <button type="button" class="btn btn-dark m-3" onclick="order()">
                                สั่งซื้อ
                            </button>
                            <input type="hidden" name="ProductID" value="<?php echo $item['id_product']; ?>">
                            <input type="hidden" name="qty" value="<?php $_SESSION['tt']; ?>">
                            <input type="hidden" name="address" value="<?php echo $item2['id_address']; ?>">
                            <input type="hidden" name="price" <?php
                                                                if ($totalsum == 1) { ?> value="   <?php echo  $total + 50 ?>     <?php } ?>" <?php
                                                                                                                                                if ($totalsum != 1) { ?> value=" <?php echo  $total + $_SESSION['pr'] = ($totalsum * 10) + 50 - 10 ?>  <?php } ?>">
                            <input type="hidden" name="price_no" value="<?php echo $total2 ?>">
                            <input type="hidden" name="OrderID_id" value="55">



                        </form>
                    </div>
                    <?php
                    $sqlpay = "SELECT * FROM tb_payment";
                    $querypay = mysqli_query($connection, $sqlpay);
                    $result = mysqli_fetch_assoc($querypay);

                    ?>
                    <div class="card mt-3">
                        <h3 class="mt-3 mx-3">การจัดส่ง</h3>
                        <div class="my-2 ">
                            <div class="mx-3">
                                Kerry Express Thailand เคอรี่ เอ็กซ์เพรส
                            </div>
                        </div>
                    </div>

                    <h3 class="m-3">การชำระเงิน</h3>
                    <div class="my-3">
                        <div class="mt-2">
                            <?php foreach ($querypay as $row) { ?>
                                <label class="px-2"> <img src="../admin/upload/payment/<?php echo $row['image'] ?>" alt="" width="50" hight="50" class=""></img></label>
                            <?php } ?>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php require_once('include/footer.php'); ?>
<script>
    function order() {

        Swal.fire({
            title: 'ยืนยันการสั่งซื้อ',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',

        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'สั่งซื้อสำเร็จ!',
                    icon: 'success',
                    showCancelButton: false,
                    showConfirmButton: false,
                    confirmButtonColor: '#3085d6',
                    timer: 1500
                }).then(() => {
                    $('#form_con').submit();
                })

            }
        })


    }
</script>

<!-- <script>
    $("#idForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                console.log(data)
            }
        });
    });
</script> -->

<!-- + บวก -->
<script>
    $(document).ready(function() {
        $('.plus').click(function() {
            var pid = $(this).attr("id");
            $.ajax({
                url: "updateCart.php",
                method: "post",
                data: {
                    id: pid
                },
                success: function(result) {
                    $('#lode').load('ajax_cart2.php');
                },
                error: function() {
                    alert('error');
                }
            })
        });
    });
</script>
<!-- - ลบ -->
<script>
    $(document).ready(function() {
        $('.delnum').click(function() {
            var pid = $(this).attr("id");
            $.ajax({
                url: "updateCart2.php",
                method: "post",
                data: {
                    id: pid
                },
                success: function(result) {

                    $('#lode').load('ajax_cart2.php');
                },
                error: function() {
                    alert('error');
                }
            })
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.del').click(function() {
            var pid = $(this).attr("id");
            $.ajax({
                url: "del_cart.php",
                method: "post",
                data: {
                    id: pid
                },
                success: function(result) {

                    $('#lode').load('ajax_cart2.php');
                },
                error: function() {
                    alert('error');
                }
            })
        });
    });
</script>