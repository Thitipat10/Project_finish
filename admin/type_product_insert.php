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


    <div class="container-fluid container">
        <h1 class="app-page-title ">เพิ่มประเภทสินค้า  <a href="type_product.php"><button type="button" class="btn btn-primary mb-4 float-right"> ย้อนกลับ</button></a></h1>
        <div class="app-card-body">
            <?php
            if (isset($_POST) && !empty($_POST)) {

                $title_type = $_POST['title_type'];
                if (!empty($user)) {
                    $sql_check = "SELECT * FROM tb_type_product WHERE title_type = '$title_type'";
                    $query_check = mysqli_query($connection, $sql_check);
                    $row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
                    if ($row_check > 0) {
                        echo "<script>
						Swal.fire({
							position: '',
							icon: 'error',
							title: 'ชื่อผู้ใช้ซ้ำ กรุณากรอกใหม่',
							showConfirmButton: false,
							timer: 1500
						  })
						</script>   ";
                    } else {

                        $sql = "INSERT INTO tb_type_product 
												   (title_type)
											VALUES ('$title_type')";

                        if (mysqli_query($connection, $sql)) {
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                        }

                        mysqli_close($connection);
                    }
                }
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data" id="form_con">
                <div class="mb-3">

                    <input type="text" class="form-control" name="title_type" id="type" placeholder="ประเภทสินค้า" required>
                    <span id="alert_type" class="text-danger"></span>
                </div>
                <button type="button" class="btn btn-primary" onclick="inserttype()">บันทึก</button>
            </form>

        </div>
        <!--//app-card-body-->
        <script>
            var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
        </script>


        <script>
            function inserttype() {

                var type = $('#type').val();



                // if (image == '') {
                //     $('#alert_image').html('กรุณาใส่รูป');

                // } else {
                //     $('#alert_image').html('');
                // }

                if (type == '') {
                    $('#alert_type').html('กรุณากรอกชื่อสินค้า');

                } else {
                    $('#alert_type').html('');
                }


                if (type != '') {
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

</body>

</html>