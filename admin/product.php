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
    <script src="js/sb-admin-2.min.js"></script>

    <div class="container-fluid bg">

        <?php
        $sqlproduct =  "SELECT * FROM tb_product   as p 
        INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
        INNER JOIN tb_color as o ON p.tb_color_id = o.id_color
        INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product 
      
       
       ";
        $queryproduct = mysqli_query($connection, $sqlproduct);
        $result = mysqli_fetch_assoc($queryproduct);

        ?>
        <h1 class="app-page-title ">จัดการข้อมูลสินค้า</h1>

        <hr class="mb-4">

        <div class="row g-4 settings-section">

            <div class="col-12 col-md-12">

                <div class="app-card app-card-settings card p-4">
                    <div class="app-card-body">
                        <div>
                            <a href="product_insert.php"> <button type="button" class="btn btn-primary mb-4 float-right ">เพิ่มข้อมูลสินค้า</button></a>

                        </div>
                        <table class="table" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">ประเภทสินค้า</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col">สี</th>
                                    <th scope="col">ไซส์</th>
                                    <th scope="col">ราคา</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เมนู</th>

                                </tr>
                            </thead>
                            <tbody>


                                <?php $i = 1;
                                foreach ($queryproduct as $key => $item) { ?>
                                    <?php

                                    $sql = "SELECT  * FROM tb_product_image as tt
                                    INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                                    WHERE statusimage = 1 AND tt.tb_product_id = '" . $item['id_product'] . "'";
                                    $query = mysqli_query($connection, $sql);
                                    $result = mysqli_fetch_assoc($query);

                                    ?>
                                    <tr>
                                        <td><?= $i++;  ?></td>
                                        <td><img src="upload/product/<?php echo $result['image']; ?>" width="100" height="100"></td>
                                        <td><?php echo $item['title_type']; ?></td>
                                        <td><?php echo $item['title']; ?></td>
                                        <td><?php echo $item['number']; ?></td>
                                        <td><?php echo $item['title_color']; ?></td>
                                        <td><?php echo $item['title_size']; ?></td>
                                        <td><?php echo number_format($item['price']); ?></td>
                                        <td><?php echo ($result['status'] == 0 ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-secondary">ปิดใช้งาน</span>'); ?></td>
                                        <td><a href="product_update.php?id=<?php echo $item["id_product"]; ?>" class="btn btn-sm btn-warning">แก้ไข</a>&nbsp;&nbsp;

                                            <?php if ($result['status'] == 0) { ?>
                                                <a href="del.php?offproduct=<?php echo $item["id_product"]; ?>" class="btn btn-sm btn-danger offproduct ">ปิดใช้งาน</a>
                                            <?php } ?>

                                            <?php if ($result['status'] == 1) { ?>
                                                <a href="del.php?onproduct=<?php echo $item["id_product"]; ?>" class="btn btn-sm btn-success onproduct">เปิดใช้งาน</a>
                                            <?php } ?>

                                        </td>

                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>


                    </div>
                    <!--//app-card-body-->

                </div>
                <!--//app-card-->
            </div>
        </div>
        <!--//row-->

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
        $('.offproduct').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'คุณต้องการปิดการแสดงสินค้า ?',
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
    <script>
        $('.onproduct').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'คุณต้องการเปิดการแสดงสินค้า ?',
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
            title: 'เปลี่ยนสถานะสำเร็จ',
            showConfirmButton: false,
            timer: 1500
          })
        </script>   ";

        unset($_SESSION['m']);
    }
    ?>


</body>


</html>