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

        $sql = "SELECT * FROM tb_orders  WHERE id_user = $id ORDER BY OrderID DESC";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_assoc($query);


        ?>




        <h1 class="app-page-title ">รายการการชำระเงิน </h1>


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
                                    <th scope="col">สถานะการชำระเงิน</th>
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
                                        <td><?php echo $result3['firstname'] ?></td>
                                        <td><?php if ($item['status'] == 0) { ?>
                                                <div class="badge badge-warning text-white">รอตรวจสอบการชำระเงิน</div>
                                            <?php  } ?>
                                            <?php if ($item['status'] == 1) { ?>
                                                <div class="badge bg-success text-white"> ชำระเงินแล้ว</div>
                                            <?php  } ?>
                                            <?php if ($item['status'] == 2) { ?>
                                                <div class="badge bg-danger text-white"> ชำระเงินผิดพลาด</div>

                                            <?php  } ?>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning text-dark" data-toggle="modal" data-target="#ID<?php echo $item['OrderID'] ?>">
                                                <i class="far fa-edit"></i> ปรับปรุงสถานะ
                                            </button>
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
        $i = 1;
        foreach ($query as $item) { ?>
            <?php
            $sqldetail =
                "SELECT * FROM tb_orders_detail as d 
                        INNER JOIN tb_product as p    ON d.ProductID = p.id_product 
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
                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการชำระเงิน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="Update_payment.php" method="POST">
                            <div class="modal-body">
                                <div>รหัสคำสั่งซื้อ : <?php echo $item['OrderID'] ?> &nbsp;ชื่อลูกค้า : <?php echo $result3['firstname'] ?></div>
                                <div>ยอดชำระ : <?php echo number_format($result2['price_pm']) ?> บาท</div>
                                <div>รูปแบบการชำระเงิน : <?php echo $result2['name_bank'] ?></div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="check" id="inlineRadio1" value="0" <?php if ($item['status'] == 0) { ?> checked <?php  } ?>>
                                    <label class="form-check-label" for="inlineRadio1"> รอตรวจสอบการชำระเงิน</label>
                                </div>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="check" id="inlineRadio2" value="1" <?php if ($item['status'] == 1) { ?> checked <?php  } ?>>
                                    <label class="form-check-label" for="inlineRadio2"> ชำระเงินเงินแล้ว</label>
                                </div>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="check" id="inlineRadio3" value="2" <?php if ($item['status'] == 2) { ?> checked <?php  } ?>>
                                    <label class="form-check-label" for="inlineRadio3"> ชำระเงินผิดพลาด</label>
                                </div>

                                <br>
                                รูปภาพหลักฐานการชําระเงิน
                                <div> <img class="container my-2" src="upload/payment_orders/<?php echo $result2['image_pm'] ?>" width="300" height="400"></div>
                            </div>
                            <button class="btn btn-success mx-5 mb-5">ยืนยัน</button>
                            <input type="hidden" name="OrderID" value="<?php echo $item['OrderID']; ?>">
                        </form>
                    </div>
                </div>
            </div>



        <?php } ?>
        <script>
            $(document).ready(function() {
                $('#table_id').DataTable();
            });
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