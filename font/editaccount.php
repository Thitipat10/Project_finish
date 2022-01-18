<?php require_once('account.php'); ?>
<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>

<?php
$user  = $_SESSION['user'];
$sql = "SELECT * FROM tb_admin WHERE user ='$user'";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);


if (isset($_POST) && !empty($_POST)) {
    if (isset($_POST['profile'])) {
        $user  = $_SESSION['user'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $sex = $_POST['sex'];
        $oldimage = $_POST['oldimage'];
        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $extension = array("jpeg", "jpg", "png");
            //ประเ  ภทไฟล์
            $target = '../admin/upload/admin/';
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
        $sql = "UPDATE tb_admin SET firstname ='$firstname',lastname='$lastname',email='$email',phone='$phone',sex='$sex',image = '$filename' WHERE user = '$user' ";

        if (mysqli_query($connection, $sql)) {
            $_SESSION['image'] = $filename;
            echo '<meta http-equiv="refresh" content="0.1; url=editaccount.php">';
            // echo "แก้ไขข้อมูลสำเร็จ ";
        } else {
            // echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}
?>
<div class="col-10 ">
    <div class="row ">

        <div class="col-12 col-lg-12 my-2 ">
            <div class="card o-hidden border-0 shadow-sm border ">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->

                    <div class="p-5">
                        <div class="text-center">
                        </div>
                        <h1 class="app-page-title mb-4  ">แก้ไขข้อมูลส่วนตัว</h1>
                        <hr class="mb-3 mt-4">
                        <img class="rounded-circle" id="output" src="../admin/upload/admin/<?= $_SESSION['image'] ?>" width="150px" height="150px" />
                        <div class="text-secondary">
                            ขนาดไฟล์: สูงสุด 1 MB
                            <br>
                            ไฟล์ที่รองรับ: jpeg.jpg.png
                        </div>

                        <form action="" method="POST" enctype="multipart/form-data" id="form_con">
                            <div class="mb-3">
                                <label class="form-label">รูปภาพ </label>
                                <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="mt-4" id="image">
                                <input type="hidden" name="oldimage" value="<?= $result['image'] ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ชื่อผู้ใช้ </label>
                                <input type="text" class="form-control" name="user" value="<?= $result['user'] ?>" placeholder="ชื่อผู้ใช้ : admin" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ชื่อ</label>
                                <input type="text" class="form-control" name="firstname" value="<?= $result['firstname'] ?>" placeholder="ขื่อ">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" name="lastname" value="<?= $result['lastname'] ?>" placeholder="นามสกุล">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">อีเมล</label>
                                <input type="email" class="form-control" name="email" value="<?= $result['email'] ?>" placeholder="อีเมล์">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">เบอร์ติดต่อ</label>
                                <input type="text" class="form-control" name="phone" value="<?= $result['phone'] ?>" placeholder="เบอร์ติดต่อ">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">เพศ</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" value="ชาย" <?php if ($result['sex'] == "ชาย") { ?> checked <?php  } ?>>
                                    <label class="form-check-label" for="ชาย">
                                        ชาย
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" value="หญิง" <?php if ($result['sex'] == "หญิง") { ?> checked <?php  } ?>>
                                    <label class="form-check-label" for="หญิง">
                                        หญิง
                                    </label>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" name="profile">
                                <input type="button" class="btn btn-primary" onclick="updateprofile()" value="อัพเดทข้อมูล">
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateprofile() {


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
</script>
<script>
    $(":file").on("change", function() {
        var output = document.getElementById('output');
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {


            $('#image').val('');

            Swal.fire({
                title: 'ประเภทไฟล์ไม่ถูกต้อง !',
                icon: 'error',
                showCancelButton: false,
                showConfirmButton: false,
                confirmButtonColor: '#3085d6',
                timer: 1500
            })
            $('#output').attr('src', '');


        } else {
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    });
</script>

</div>

</div>
<?php require_once('include/footer.php'); ?>