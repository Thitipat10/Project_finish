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

$sql = "SELECT * FROM province";
$query = mysqli_query($connection, $sql);


$sql2 = "SELECT * FROM district";
$query2 = mysqli_query($connection, $sql2);


$sql3 = "SELECT * FROM tambon";
$query3 = mysqli_query($connection, $sql3);

$sqladdress = "SELECT * FROM tb_address as a
INNER JOIN province  as p ON a.province = p.ProvinceID
INNER JOIN tambon as d ON a.districts = d.TambonID
INNER JOIN district as t ON a.amphures = t.DistrictID
WHERE  a.user = '" . @$_SESSION['id'] .  "'";

$resultaddress = mysqli_query($connection, $sqladdress);
$resultad = mysqli_fetch_assoc($resultaddress);
$addrow = mysqli_num_rows($resultaddress);
// $reee = mysqli_fetch_assoc($resultaddress);


?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

<div class="bg-card p-5">

    <div class="container ">
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb  float-center">
                <li class="breadcrumb-item text-type" aria-current="page">รถเข็น</li>
                <li class="breadcrumb-item active" aria-current="page">สั่งซื้อ</li>

            </ul>
        </nav>
        <div class="col-md-12 mx-auto">
            <div class="row">

                <div class="col-md-8 mx-auto mt-5">
                    <div class="card mb-3">
                        <i class="fas fa-map-marker-alt px-3 pt-3"> ที่อยู่ในการจัดส่ง</i>
                        <?php if (!empty($resultad['id_address'])) { ?>
                            <?php foreach ($resultaddress as $row) { ?>
                                <?php if ($row['status'] == 0) { ?>
                                    <div class="p-3">
                                        <label class="text-type"><?php echo $row['firstname'] ?>
                                            <?php echo $row['lastname'] ?>
                                            <?php echo $row['phone'] ?></label>
                                        <?php echo $row['address_details'] ?>,
                                        เขต<?php echo $row['DistrictName']; ?>,
                                        จังหวัด <?php echo $row['ProvinceThai']; ?>,
                                        <?php echo $row['zipcode']; ?>
                                    </div>
                                <?php } ?>

                            <?php } ?>
                            <!-- Button trigger modal edit address -->
                            <div>
                                <a href="" class="mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal"> เปลี่ยน</a>
                            </div>

                            <!-- Modal edit address-->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ที่อยู่ในการจัดส่ง
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="address_status.php" method="POST">
                                                <?php foreach ($resultaddress as $row) { ?>

                                                    <?php if ($row['status'] == 0) { ?>
                                                        <div class="p-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="check" id="inlineRadio1" value="<?php echo $row['id_address'] ?>" <?php if ($row['status'] == 0) { ?> checked <?php } ?>>
                                                                <label class=" form-check-label" for="inlineRadio1"><label class="text-type"><?php echo $row['firstname'] ?>
                                                                        <?php echo $row['lastname'] ?>
                                                                        <?php echo $row['phone'] ?></label>
                                                                    <?php echo $row['address_details'] ?>,
                                                                    เขต<?php echo $row['DistrictName']; ?>,
                                                                    จังหวัด <?php echo $row['ProvinceThai']; ?>,
                                                                    <?php echo $row['zipcode']; ?></label>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($row['status'] == 1) { ?>
                                                        <div class="p-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="check" id="inlineRadio1" value="<?php echo $row['id_address'] ?>" <?php if ($row['status'] == 0) { ?> checked <?php } ?>>
                                                                <label class=" form-check-label" for="inlineRadio1"><label class="text-type"><?php echo $row['firstname'] ?>
                                                                        <?php echo $row['lastname'] ?>
                                                                        <?php echo $row['phone'] ?></label>
                                                                    <?php echo $row['address_details'] ?>,
                                                                    เขต<?php echo $row['DistrictName']; ?>,
                                                                    จังหวัด <?php echo $row['ProvinceThai']; ?>,
                                                                    <?php echo $row['zipcode']; ?></label>
                                                            </div>
                                                        </div>
                                                    <?php } ?>



                                                <?php } ?>
                                                <div class="modal-footer">
                                                    <button type="sumbit" class="btn btn-primary">ยืนยัน</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>


                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (empty($resultad['id_address'])) { ?>
                            <button type="button " class="btn btn-orange float-end m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                + เพิ่มที่อยู่
                            </button>

                            <!-- Modal + -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> ที่อยู่จัดส่ง</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="address_db2.php" method="POST">
                                            <div class="modal-body">
                                                <hr>

                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control me-3" placeholder="ชื่อ" name="firstname">

                                                    <input type="text" class="form-control" placeholder="นามสกุล" name="lastname">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="หมายเลขโทรศัพท์" name="phone">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <Select class="form-select" name="province" id="province">
                                                        <option value="" selected disabled>กรุณาเลือกจังหวัด</option>
                                                        <?php foreach ($query as $value) { ?>
                                                            <option value="<?php echo $value['ProvinceID']; ?>">
                                                                <?php echo $value['ProvinceThai']; ?> </option>
                                                        <?php } ?>
                                                    </Select>
                                                    <Select class="form-select" name="amphures" id="amphures">
                                                        <option selected disabled>กรุณาเลือกอำเภอ</option>
                                                    </Select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <Select class="form-select" name="districts" id="districts">
                                                        <option selected disabled>กรุณาเลือกตำบล</option>
                                                    </Select>
                                                    <input class="form-control" type="text" name="zipcode" id="zipcode" placeholder="รหัสไปรษณีย์">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <textarea type="text" class="form-control textarea" name="address_details" id="" cols="30" rows="10" placeholder="รายละเอียดที่อยู่" style="height: 60px"></textarea>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status0" id="inlineRadio1" value="0">
                                                    <label class="form-check-label" for="inlineRadio1"> ตั่งค่าเริ่มต้น</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">ยืนยัน</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="mx-3 mb-3"></div>
                    </div>
                    <div class="card p-2">
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
                                $totalsum = 0;
                                ?>
                                <div class="pt-3">

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
                                                <div class="col-md-7 linkproduct">

                                                    <a href="product_detail.php?id=<?php echo $item['id_product'] ?>">
                                                        <label class="text-type"><?php echo $item['title'] ?></label></a>

                                                    <br>
                                                    <br>
                                                    <label class="">ไซส์ : <?php echo $item['title_size'] ?></label>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <form action="del_cart.php?del_cart=<?php echo $item['id_cart'] ?>" method="POST" id="form_con2">
                                                        <label onclick="del_cart()"> <i class="fas fa-trash"></i></a></label>

                                                    </form>

                                                    <script>
                                                        function del_cart() {

                                                            Swal.fire({
                                                                title: 'ต้องการลบสินค้า ?',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'ตกลง',
                                                                cancelButtonText: 'ยกเลิก',
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    Swal.fire({
                                                                        title: 'ลบสินค้าสำเร็จ',
                                                                        icon: 'success',
                                                                        showCancelButton: false,
                                                                        showConfirmButton: false,
                                                                        confirmButtonColor: '#3085d6',
                                                                        timer: 1500
                                                                    }).then(() => {
                                                                        $('#form_con2').submit();
                                                                    })

                                                                }
                                                            })
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label class='text-type'>&#3647;<?php echo number_format($item['price']) ?></label>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($item['qty'] == 1) { ?>
                                                <span class="btn btn-orange2  dell" id="<?php echo $item['productID'] ?>">-</span>
                                            <?php    } ?>

                                            <?php
                                            if ($item['qty'] > 1) { ?>
                                                <span class="delnum btn btn-orange2" id="<?php echo $item['productID'] ?>">-</span>
                                            <?php    } ?>

                                            <input class="input-number" name="qty" type="text" min="1" max="<?php echo $item['number']; ?>" value="<?php echo $item['SUM'] ?>" id="numberqty">

                                            <?php
                                            if ($item['qty'] >= $item['number']) { ?>
                                                <span class="btn btn-orange2 pluss" id="<?php echo $item['productID'] ?>">+</span>

                                            <?php    } ?>

                                            <?php
                                            if ($item['qty'] < $item['number']) { ?>
                                                <span class="btn btn-orange2 plus" id="<?php echo $item['productID'] ?>">+</span>
                                            <?php    } ?>
                                        </td>
                                        <td>
                                            <label class='text-type'>&#3647;<?php echo number_format($item['SUM'] * $item['price']) ?></label>
                                        </td>

                                    </tr>


                                    <?php $total += $item['SUM'] * $item['price'] ?>
                                    <?php $_SESSION['tt'] = $totalsum += $item['SUM'] ?>
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

                                    <label class="float-left">ยอดรวมสินค้า (<?php echo $_SESSION['tt']; ?>) </label>
                                    <br>
                                    <label class="float-left mt-2">การจัดส่ง</label>
                                    <br>
                                    <label class="float-left mt-4">ยอดรวมชำระทั้งหมด</label>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="m-3">

                                    <label class='text-dannger float-end'>&#3647;<?php echo number_format($total) ?>.00</label>
                                    <br>
                                    <?php
                                    if ($totalsum == 1) { ?>
                                        <label class="float-end mt-2">&#3647;50.00</label>
                                    <?php } ?>


                                    <?php
                                    if ($totalsum != 1) { ?>
                                        <label class="float-end mt-2"> &#3647;<?php echo ($totalsum * 10) + 50 - 10 ?>.00</label>
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
                        <div>

                        </div>
                        <form action="order.php" id="form_con">

                            <button type="button" class="btn btn-dark m-3 order" onclick="order()"> สั่งซื้อ</button>


                        </form>



                    </div>
                    <?php
                    $sqlpay = "SELECT * FROM tb_payment";
                    $querypay = mysqli_query($connection, $sqlpay);
                    $result = mysqli_fetch_assoc($querypay);

                    ?>
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

<input type="hidden" id="addrow" value="<?php echo $addrow ?>">

<script>
    function order() {

        var addrow = $('#addrow').val();

        if (addrow == 0) {
            Swal.fire({
                title: 'กรุณาเพิ่มที่อยู่',
                icon: 'error',
                showCancelButton: false,
                showConfirmButton: false,
                confirmButtonColor: '#3085d6',
                timer: 1500
            })
        } else {
            $('#form_con').submit();
        }
    
    }
</script>
<script type="text/javascript">
    $('#province').change(function() {
        var id_province = $(this).val();
        $.ajax({
            type: "post",
            url: "ajax_address.php",
            data: {
                id: id_province,
                function: 'provinces'
            },
            success: function(data) {
                $('#amphures').html(data);
                $('#districts').html('');
                $('#zipcode').val('');
            }
        });
    });
</script>
<script type="text/javascript">
    $('#amphures').change(function() {
        var id_amphures = $(this).val();
        $.ajax({
            type: "post",
            url: "ajax_address.php",
            data: {
                id: id_amphures,
                function: 'amphures'
            },
            success: function(data) {
                $('#districts').html(data);
            }
        });
    });
</script>
<script type="text/javascript">
    $('#districts').change(function() {
        var id_districts = $(this).val();
        $.ajax({
            type: "post",
            url: "ajax_address.php",
            data: {
                id: id_districts,
                function: 'districts'
            },
            success: function(data) {
                // console.log(data)
                $('#zipcode').val(data)
            }
        });
    });
</script>

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
<script>
    $(document).ready(function() {
        $('.pluss').click(function() {
            var pid = $(this).attr("id");
            $.ajax({
                url: "",
                method: "post",
                data: {
                    id: pid
                },
                success: function(result) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'จำนวนสินค้าคงเหลือ <?php echo $item['number']; ?> ชิ้น',
                        showConfirmButton: false,
                        timer: 1500
                    })
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