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
    <title>SB Admin 2 - Dashboard</title>
    <?php require_once('include/linkcss.php') ?>
    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
</head>

<body id="page-top">

    <?php require_once('include/header.php') ?>
    <script src="js/sb-admin-2.min.js"></script>

    <div class="container-fluid ">
        <?php
        $query = "SELECT * FROM tb_type_product";
        $result = mysqli_query($connection, $query);
        ?>
        <h1 class="app-page-title ">จัดการประเภทสินค้า</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-12">
                <div class="app-card app-card-settings card p-4">
                    <div class="app-card-body">
                        <div>
                            <a href="type_product_insert.php"> <button type="button" class="btn btn-primary mb-4 float-right">เพิ่มประเภทสินค้า</button></a>

                        </div>
                        <table class="table" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ประเภทสินค้า</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เมนู</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($result as $row) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?php echo $row['title_type']; ?></td>
                                        <td><?php echo ($row['status'] == 0 ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-secondary">ปิดใช้งาน</span>'); ?></td>
                                        <td><a href="type_product_update.php?id=<?php echo $row["id_type_product"]; ?>" class="btn btn-sm btn-warning">แก้ไข</a>&nbsp;&nbsp;

                                            <?php if ($row['status'] == 0) { ?>
                                                <a href="del.php?off_type=<?php echo $row['id_type_product'] ?>" class="btn btn-sm btn-danger off_type">ปิดใช้งาน</a>

                                            <?php } ?>

                                            <?php if ($row['status'] == 1) { ?>
                                                <a href="del.php?on_type=<?php echo $row['id_type_product'] ?>" class="btn btn-sm btn-success on_type">เปิดใช้งาน</a>


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
        <script>
            $('.off_type').on('click', function(e) {
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
            $('.on_type').on('click', function(e) {
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
    </div>
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

    <?php require_once('include/footer.php') ?>

</body>

</html>