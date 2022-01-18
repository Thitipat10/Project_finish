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

        <div class="app-card-body">
            <?php
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tb_admin WHERE id ='$id'";
                $query = mysqli_query($connection, $sql);
                $result = mysqli_fetch_assoc($query);
            }

            if (isset($_POST) && !empty($_POST)) {

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $oldimage = $_POST['oldimage'];
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $extension = array("jpeg", "jpg", "png");
                    //ประเภทไฟล์
                    $target = 'upload/admin/';
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
                    $filename = $oldimage;
                }
                //echo $filename;
                //exit(); 
                $sql = "UPDATE tb_admin SET firstname ='$firstname',lastname='$lastname',email='$email',phone='$phone',image = '$filename' WHERE id= '$id' ";

                if (mysqli_query($connection, $sql)) {
                    echo "แก้ไขข้อมูลสำเร็จ ";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }

                mysqli_close($connection);
            }
            ?>
            <h1 class="app-page-title mb-4 ">แก้ไขขอมูลผู้ดูแลระบบ <a href="admin.php"> <button type="button" class="btn btn-primary mb-4 float-right">ย้อนกลับ</button></a></h1>
            <img id="output" src="upload/admin/<?= $result['image'] ?>" width="150px" height="150px" />
            <form action="" method="POST" enctype="multipart/form-data" id="form_con">
                <div class="mb-3">
                    <label class="form-label">รูปภาพ </label>
                    <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="mt-4">
                    <input type="hidden" name="oldimage" value="<?= $result['image'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อผู้ใช้ </label>
                    <input type="text" class="form-control" name="user" value="<?= $result['user'] ?>" placeholder="ชื่อผู้ใช้ : admin" required disabled>
                </div>

                <hr class="mb-3 mt-4">
                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" name="firstname" value="<?= $result['firstname'] ?>" placeholder="ขื่อ" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" name="lastname" value="<?= $result['lastname'] ?>" placeholder="นามสกุล" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">อีเมล์</label>
                    <input type="email" class="form-control" name="email" value="<?= $result['email'] ?>" placeholder="อีเมล์" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">เบอร์ติดต่อ</label>
                    <input type="text" class="form-control" name="phone" value="<?= $result['phone'] ?>" placeholder="เบอร์ติดต่อ" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="updateadmin()">บันทึก</button>
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
            function updateadmin() {

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