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
        <h1 class="app-page-title ">รูปแบบการชำระเงิน <a href="payment.php"> <button type="button" class="btn btn-primary mb-4 float-right">ย้อนกลับ</button></a></h1>
        <div class="app-card-body">
            <?php
            if (isset($_POST) && !empty($_POST)) {

                $name_bank = $_POST['name_bank'];
                $name_payment = $_POST['name_payment'];
                $number_bank = $_POST['number_bank'];

                if (!empty($user)) {
                    $sql_check = "SELECT * FROM tb_payment WHERE number_bank = '$number_bank'";
                    $query_check = mysqli_query($connection, $sql_check);
                    $row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
                    if ($row_check > 0) {
                        echo "<script>
						Swal.fire({s
							position: '',
							icon: 'error',
							title: 'รูปแบบการชำระเงินมีอยู่ในระบบแล้ว',
							showConfirmButton: false,
							timer: 1500
						  })

						</script>    ";
                    } else {
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
                        //echo $filename;
                        //exit(); 
                        if (!empty($user)) {
                            $sql_check = "SELECT * FROM tb_payment WHERE number_bank = '$number_bank'";
                            $query_check = mysqli_query($connection, $sql_check);
                            $row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
                            if ($row_check > 0) {
                                echo 'ชื่อผู้ใช้ซ้ำ กรุณากรอกใหม่อีกครั้ง';
                            }
                        }
                        $sql = "INSERT INTO tb_payment 
												   (name_bank, name_payment, number_bank, image)
											VALUES ('$name_bank', '$name_payment', '$number_bank','$filename')";

                        if (mysqli_query($connection, $sql)) {
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                        }

                        mysqli_close($connection);
                    }
                }
            }
            ?>
            <img id="output" width="150px" height="150px" />
            <form action="" method="POST" enctype="multipart/form-data" id="form_con">
                <div class="mb-3">
                    <label class="form-label">เลือกรูปภาพ </label>
                    <span id="alert_image" class="text-danger"></span>
                    <input type="file" accept="image/*" onchange="loadFile(event)" name="image" id="image" class="mt-4">

                    <hr class="mb-3 mt-4">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อธนาคาร</label>
                    <input type="text" class="form-control" name="name_bank" id="name_bank" placeholder="ชื่อธนาคาร" required>
                    <span id="alert_name_bank" class="text-danger"></span>
                </div>


                <div class="mb-3">
                    <label class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" class="form-control" name="name_payment" id="name_payment" placeholder="ชื่อ-นามสกุล" required>
                    <span id="alert_name_payment" class="text-danger"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label">เลขที่บัญชี</label>
                    <input type="text" class="form-control" name="number_bank" id="number_bank" placeholder="เลขที่บัญชี" required>
                    <span id="alert_number_bank" class="text-danger"></span>
                </div>
                <button type="button" class="btn btn-primary" onclick="insertpayment()">บันทึก</button>
            </form>

        </div>
        <!--//app-card-body-->
        <!-- <script>
            var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
        </script> -->


        <script>
            function insertpayment() {

                var image = $('#image').val();
                var name_bank = $('#name_bank').val();
                var name_payment = $('#name_payment').val();
                var number_bank = $('#number_bank').val();



                if (image == '') {
                    $('#alert_image').html('กรุณาใส่รูป');

                } else {
                    $('#alert_image').html('');
                }
                if (name_bank == '') {
                    $('#alert_name_bank').html('กรุณากรอกชื่อผู้ใช้');
                } else {
                    $('#alert_name_bank').html('');
                }
                if (name_payment == '') {
                    $('#alert_name_payment').html('กรุณากรอกรหัสผ่าน');

                } else {
                    $('#alert_name_payment').html('');
                }
                if (number_bank == '') {
                    $('#alert_number_bank').html('กรุณากรอกชื่อ');

                } else {
                    $('#alert_number_bank').html('');
                }


                if (image != '' & name_bank != '' & name_payment != '' & number_bank != '') {
                    Swal.fire({
                        title: 'ยืนยันการเปลี่ยนข้อมูล',

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
<!-- เช็คไฟล์รูป -->
<script>
    $(":file").on("change", function() {
                var output = document.getElementById('output');
                var file = this.files[0];
                var fileType = file["type"];
                var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
                if ($.inArray(fileType, validImageTypes) < 0) {

                    Swal.fire({
                            title: 'ประเภทไฟล์ไม่ถูกต้อง !',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            confirmButtonColor: '#3085d6',
                            timer: 1500
                        })

                        $('#image').val('');


                        $('#output').attr('src', 'https://i1.sndcdn.com/artworks-000335143458-q3i6f4-t500x500.jpg');


                    }
                    else {
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                        }
                    }
                });
</script>
</body>

</html>