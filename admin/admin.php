<!DOCTYPE html>
<html lang="en">

<?php require_once('include/script.php') ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    
  
    <title>Admin</title>
    <?php require_once('include/linkcss.php') ?>
    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
</head>

<body id="page-top">

    <?php require_once('include/header.php') ?>
    <script src="js/sb-admin-2.min.js"></script>
    <?php
    $query = "SELECT * FROM tb_admin WHERE role = 'a' OR  role = 'headeramin'";
    $result = mysqli_query($connection, $query);



    ?>





    <div class="container-fluid ">
        <h1 class="app-page-title ">ตารางข้อมูลผู้ดูแลระบบ</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-12">
                <div class="app-card app-card-settings card p-4">
                    <div class="app-card-body">
                        <div>
                            <a href="admin_insert.php"> <button type="button" class="btn btn-primary mb-4 float-right">เพิ่มข้อมูลผู้ดูแลระบบ</button></a>

                        </div>
                        <table class="table" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">ชื่อผู้ใช้</th>
                                    <th scope="col">อีเมล์</th>
                                    <th scope="col">เบอร์ติดต่อ</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เมนู</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row) { ?>
                                    <tr>
                                        <td><img src="upload/admin/<?php echo $row['image'] ?>" width="100" height="100"></td>
                                        <td><?php echo $row['user']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo ($row['status'] == 0 ? '<span class="text-success">เปิดใช้งาน</span>' : '<span class="text-secondary">ปิดใช้งาน</span>'); ?></td>
                                        <td><a href="admin_update.php?id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-warning">แก้ไข</a>&nbsp;&nbsp;
                                            <?php if (@@$_SESSION['user'] == 'admin') { ?>
                                                <?php if (@$row['status'] == 0) { ?>
                                                    <a href="member_status.php?offadmintest=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger offadmin ">ปิดใช้งาน</a>
                                                <?php } ?>

                                                <?php if (@$row['status'] == 1) { ?>
                                                    <a href="member_status.php?onadmintest=<?php echo $row["id"]; ?>" class="btn btn-sm btn-success onadmin">เปิดใช้งาน</a>
                                                <?php } ?>

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

    <script>
        $('.offadmin').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'คุณต้องการปิดรหัสผู้ใช้ ?',
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
        $('.onadmin').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'คุณต้องการเปิดรหัสผู้ใช้ ?',
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
        $('.del_admin').on('click', function(e) {
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