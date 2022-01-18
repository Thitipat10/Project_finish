<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <title>Product</title>
    <?php require_once('include/linkcss.php') ?>
    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
</head>

<body id="page-top">

    <?php require_once('include/header.php') ?>

    <?php require_once('include/headerpayment_status.php') ?>



    <script src="js/sb-admin-2.min.js"></script>

    <div class="container-fluid bg">
        <?php
        $id = $_SESSION['id'];

        $sql = "SELECT * FROM tb_orders  WHERE  status = 3 OR status = 5 ORDER BY OrderID DESC";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_assoc($query);


        ?>




        <h1 class="app-page-title ">รายการจัดส่ง</h1>


        <hr class="mb-4">

        <div class="row g-4 settings-section">

            <div class="col-12 col-md-12">

                <div class="app-card app-card-settings card p-4">
                    <div class="app-card-body">
                        <div>
                        </div>
                        <table class="table" id="table_id">
                            <thead class="">
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">เลขที่คำสั่งซื้อ</th>
                                    <th scope="col">วันที่ชำระเงิน</th>
                                    <th scope="col">ชื่อลูกค้า</th>
                                    <th scope="col">รายละเอียดการสั่งซื้อ</th>
                                    <th scope="col">สถานะการจัดส่ง</th>
                                    <th scope="col">จัดการ</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($query as $key => $item) { ?>
                                    <?php
                                    $sqladdress =
                                        "SELECT * FROM tb_address_orders as do 
                                INNER JOIN tb_address as a ON do.id_address = a.id_address    
                                WHERE do.OrderID = '" . $item['OrderID'] . "' ";
                                    $query3 = mysqli_query($connection, $sqladdress);
                                    $result3 = mysqli_fetch_assoc($query3);
                                    ?>
                                    <tr>

                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $item['OrderID'] ?></td>
                                        <td><?php echo $item['OrderDate'] ?></td>
                                        <td><?php echo @$result3['firstname'] ?></td>
                                        <td> <button type="button" class="btn btn-warning text-dark" data-toggle="modal" data-target="#ID2<?php echo $item['OrderID'] ?>">
                                                <i class="far fa-edit"></i> รายละเอียดการสั่งซื้อ
                                            </button> </td>
                                        <td><?php if ($item['status'] == 2) { ?>
                                                <div class="badge badge-warning text-white">รอตรวจสอบการชำระเงิน</div>
                                            <?php  } ?>
                                            <?php if ($item['status'] == 3) { ?>
                                                <div class="badge bg-success text-white">
                                                    ยังไม่ดำเนินการจัดส่ง</div>
                                            <?php  } ?>
                                            <?php if ($item['status'] == 4) { ?>
                                                <div class="badge bg-danger text-white"> ชำระเงินผิดพลาด</div>

                                            <?php  } ?>
                                            <?php if ($item['status'] == 5) { ?>
                                                <div class="badge bg-success text-white"> กำลังจัดส่ง</div>

                                            <?php  } ?>

                                        </td>
                                        <td>
                                            <?php if ($item['status'] == 2) { ?>
                                                <button type="button" disabled class="btn btn-warning text-dark" data-toggle="modal" data-target="#ID<?php echo $item['OrderID'] ?>">
                                                    <i class="far fa-edit"></i> รอตรวจสอบการชำระเงิน
                                                </button>
                                            <?php  } ?>
                                            <?php if ($item['status'] == 3) { ?>
                                                <button type="button" class="btn btn-warning text-dark" data-toggle="modal" data-target="#ID<?php echo $item['OrderID'] ?>">
                                                    <i class="fas fa-truck-moving"></i> ดำเนินการจัดส่ง
                                                </button>
                                            <?php  } ?>
                                            <?php if ($item['status']  >= 1) { ?>
                                                <a href="delivery_note.php?id=<?php echo $item['OrderID'] ?>" class="btn btn-danger"><i class="fas fa-print"></i> พิมพ์ที่อยู่</a>
                                                <a href="receipt.php?id=<?php echo $item['OrderID'] ?>" class="btn btn-danger"><i class="fas fa-print"></i> พิมพ์ใบเสร็จ</a>
                                            <?php  } ?>


                                        </td>



                                    </tr>
                                <?php  } ?>

                            </tbody>
                        </table>


                    </div>
                    <!--//app-card-body-->

                </div>
                <!--//app-card-->
            </div>
        </div>
        <!--//row-->
        <?php
        if (isset($_POST) && !empty($_POST)) {
            // print_r($_POST);

            $parcel_number = $_POST['parcel_number'];
            $status = 5;
            $OrderID = $_POST['OrderID'];
            $Delivery_END = date('Y-m-d H:i:s', strtotime("14day 12:00:00"));

            $sqlnumber =  "UPDATE tb_orders  SET status='$status' ,parcel_number='$parcel_number' ,Delivery_END='$Delivery_END' WHERE OrderID = $OrderID";
            $querynumber = mysqli_query($connection, $sqlnumber);
        }

        ?>

        <?php
        $i = 1;
        foreach ($query as $item) { ?>
            <?php
            $sqldetail =
                "SELECT * FROM tb_orders_detail as d 
                        INNER JOIN tb_product as p  ON d.ProductID = p.id_product 
                        INNER JOIN tb_payment_orders as pm  ON d.OrderID = pm.id_order
                        INNER JOIN tb_payment as py  ON pm.id_bank = py.id_payment
                        WHERE d.OrderID = '" . $item['OrderID'] . "' ";
            $query2 = mysqli_query($connection, $sqldetail);
            $result2 = mysqli_fetch_assoc($query2);
            ?>
            <div class="modal fade" id="ID<?php echo $item['OrderID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">เลขพัสดุ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="delivery_status.php" method="POST" id="form_con2">
                            <div class="modal-body text-dark text-center">
                                <div>รหัสคำสั่งซื้อ : <?php echo $item['OrderID'] ?> &nbsp;ชื่อลูกค้า : <?php echo $result3['firstname'] ?>&nbsp;<?php echo $result3['lastname'] ?></div>

                                <input type="text" name="parcel_number" placeholder="เลขพัสดุ" class="form-control mt-2">
                            </div>
                            <button class="btn btn-success mx-5 mb-5 " type="button" onclick="orderupdate()">ยืนยัน</button>
                            <input type="hidden" name="OrderID" value="<?php echo $item['OrderID']; ?>">
                            <input type="hidden" name="check" value="3">
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function orderupdate() {

                    Swal.fire({
                        title: 'ยืนยันการเปลี่ยนสถานะ',

                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก',

                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'เปลี่ยนสถานะสำเร็จ!',
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

            <div class="modal fade" id="ID2<?php echo $item['OrderID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการชำระเงิน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="Update_payment.php" method="POST">
                            <div class="modal-body">
                                <div>รหัสคำสั่งซื้อ : <?php echo $item['OrderID'] ?> &nbsp;ชื่อลูกค้า : <?php echo $result3['firstname'] ?> &nbsp;<?php echo $result3['lastname'] ?></div>
                                <div>ยอดชำระ : <?php echo number_format($result2['price_pm']) ?> บาท</div>
                                <?php foreach ($query2 as $item2) { ?>
                                    <?php
                                    $sql = "SELECT  * FROM tb_product_image as tt
                                     INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                                     WHERE tt.tb_product_id = '" . $item2['id_product'] . "'";
                                    $query = mysqli_query($connection, $sql);
                                    $result = mysqli_fetch_assoc($query);
                                    ?>
                                    <div class="row p-3">
                                        <div class="col-4">
                                            <img class="" src="../admin/upload/product/<?php echo $result['image'] ?>" width="150" height="150">
                                        </div>
                                        <div class="col-6">
                                            <?php echo $item2['title'] ?>
                                            <div>
                                                จำนวน <?php echo $item2['Qty'] ?> ชิ้น
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="float-end">
                                                &#3647;<?php echo number_format($item2['price'] * $item2['Qty']); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                            <input type="hidden" name="OrderID" value="<?php echo $item['OrderID']; ?>">
                        </form>
                    </div>
                </div>
            </div>

        <?php } ?>
        <script>
            $(document).ready(function() {
                $('#table_id').DataTable({
                    "pageLength":10,
                    "lengthChange": true,
                    "language": {
            "lengthMenu": "แสดง _MENU_ ข้อมูล",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้า _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "search":"ค้นห้า",
            "searchPlaceholder":"ค้นหา...",
            "paginate": {
            "first": "หน้าแรก",
            "previous": "ก่อนหน้า",
            "next": "ถัดไป",
            "last": "หน้าสุดท้าย",
          
    },
        }

                }

                );
                
            }
            
            );
        </script>

        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </div>

    <?php require_once('include/footer.php') ?>


    <script>
        $('.del_product').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'คุณต้องการลบ ID ผู้ใช้ ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;

                }
            })
        });
    </script>
    <?php
    if (@$_SESSION['m'] == 1) {
        echo "<script>
        Swal.fire({
            position: '',
            icon: 'success',
            title: 'ลบสำเร็จ',
            showConfirmButton: false,
            timer: 1500
          })
        </script>   ";

        unset($_SESSION['m']);
    }
    ?>

</body>


</html>