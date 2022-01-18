<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin</title>
    <?php require_once('include/linkcss.php') ?>
    <?php require_once('connection/connection.php') ?>

</head>

<body id="page-top">

    <?php require_once('include/header.php') ?>


    <div class="container-fluid container  card p-3">
        <h1 class="app-page-title ">รูปแบบการชำระเงิน<a href="payment.php"> <button type="button" class="btn btn-primary mb-4 float-right">ย้อนกลับ</button></a></h1>
        <div class="app-card-body">
            <?php
            if (isset($_GET['id']) && !empty($_GET['id'])) {

                $id = $_GET['id'];

                $sqlpayment =
                    "SELECT * FROM tb_payment 
                WHERE id_payment ='$id'";
                $querypayment = mysqli_query($connection, $sqlpayment);
                $resultpayment = mysqli_fetch_assoc($querypayment);


                if (isset($_POST) && !empty($_POST)) {
                    // echo '<pre>';
                    // print_r($_POST);
                    // echo '</pre>';
                    $name_bank = $_POST['name_bank'];
                    $name_payment = $_POST['name_payment'];
                    $number_bank = $_POST['number_bank'];


                    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                        $extension = array("jpeg", "jpg", "png");
                        //ประเภทไฟล์
                        $target = 'upload/payment/';
                        //ไฟล์ที่จะเก็บรูปภาพ
                        $filename = $_FILES['image']['name'];
                        $filetmp = $_FILES['image']['tmp_name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        // เรียกไฟล์เฉพาะ.
                        //echo $ext;
                        if (in_array($ext, $extension)) {
                            if (!file_exists($target . $filename)) {  // ไม่มีชื่อไฟล์ซ้ำ
                                if (move_uploaded_file($filetmp, $target . $filename)) {
                                    $filename = $filename;
                                } else {
                                    echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
                                }
                            } else {
                                $newfilename = time() . $filename;
                                if (move_uploaded_file($filetmp, $target . $newfilename)) {
                                    $filename = $newfilename;
                                } else {
                                    echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
                                }
                            }
                        } else {
                            echo 'ประเภทไฟล์ไม่ถูกต้อง';
                        }
                    } else {
                        $filename = '';
                    }

                    $sql = "UPDATE tb_payment SET name_bank ='$name_bank',name_payment='$name_payment',number_bank='$number_bank',image='$filename' WHERE id_payment = '$id' ";

                    $query = mysqli_query($connection, $sql);
                }
            }
            ?>
            <img id="output" src="upload/payment/<?= $resultpayment['image'] ?>" width="150px" height="150px" />
            <form action="" method="POST" enctype="multipart/form-data" id="form_con">
                <div class="mb-3">
                    <label class="form-label">เลือกรูปภาพ </label>
                    <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="mt-4">

                    <hr class="mb-3 mt-4">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อธนาคาร</label>
                    <input type="text" class="form-control" name="name_bank" value="<?= $resultpayment['name_bank']; ?>" placeholder="ชื่อธนาคาร">
                </div>


                <div class="mb-3">
                    <label class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" class="form-control" name="name_payment" value="<?= $resultpayment['name_payment']; ?>" placeholder="ชื่อ-นามสกุล">
                </div>
                <div class="mb-3">
                    <label class="form-label">เลขที่บัญชี</label>
                    <input type="text" class="form-control" name="number_bank" value="<?= $resultpayment['number_bank']; ?>" placeholder="เลขที่บัญชี">
                </div>
                <button type="button" class="btn btn-primary" onclick="updatepayment()">บันทึก</button>
            </form>

        </div>
        <!--//app-card-body-->
        <script>
            $(":file").on("change", function() {
                var output = document.getElementById('output');
                var file = this.files[0];
                var fileType = file["type"];
                var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
                if ($.inArray(fileType, validImageTypes) < 0) {

                    Swal.fire({
                        title: 'ประเภทไฟล์ไม่ถูกต้อง !',
                        icon: 'error',
                        showCancelButton: false,
                        showConfirmButton: false,
                        confirmButtonColor: '#3085d6',
                        timer: 1500
                    })

                    $('#image').val('');


                    $('#output').attr('src', 'https://i1.sndcdn.com/artworks-000335143458-q3i6f4-t500x500.jpg');


                } else {
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                    }
                }
            });
        </script>

        <script>
            function updatepayment() {
                Swal.fire({
                    title: 'ยืนยันการแก้ไข',

                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',

                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'เปลี่ยนข้อมูลสำเร็จ!',
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

</body>

</html>


</div>
<!--//container-fluid-->
</div>
<!--//app-content-->


</div>
<!--//app-wrapper-->



</div>

<?php require_once('include/footer.php') ?>
<?php require_once('include/script.php') ?>

</body>

</html>