<title>เปลี่ยนรหัสผ่าน</title>

<?php require_once('account.php'); ?>
<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php
$user  = $_SESSION['user'];
$sql = "SELECT * FROM tb_admin WHERE user ='$user'";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);


if (isset($_POST) && !empty($_POST)) {
    if (isset($_POST['changpassword'])) {
        // echo 'pre';
        // print_r($_POST);
        // echo '</pre>';
        $oldpassword = md5($_POST['oldpassword']);
        $newpassword = md5($_POST['newpassword']);
        $confirmnewpassword = md5($_POST['confirmnewpassword']);
        if (isset($oldpassword) && !empty($oldpassword)) {
            $sql_check = "SELECT * FROM tb_admin WHERE user= '$user' AND pass = '$oldpassword'";
            $query_check = mysqli_query($connection, $sql_check);
            $row_check = mysqli_num_rows($query_check);
            if ($row_check == 0) {
                echo '<meta http-equiv="refresh" content="0.1; url=changepassword.php">';
            } else {
                if ($newpassword !== $confirmnewpassword) {
                    echo '<meta http-equiv="refresh" content="0.1; url=changepassword.php">';
                } else {
                    $sql = "UPDATE tb_admin SET pass = '$newpassword' WHERE user='$user'";
                    if (mysqli_query($connection, $sql)) {
                        echo '<meta http-equiv="refresh" content="0.1; url=changepassword.php">';
                        // echo "แก้ไขข้อมูลสำเร็จ ";
                    } else {
                        // echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                    }

                    mysqli_close($connection);
                }
            }
        }
    }
}

?>
<div class="col-10">
    <div class="row">

        <div class="col-12 col-lg-12 my-2">
            <div class="card o-hidden border-0 shadow-sm ">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->

                    <div class="p-5">
                        <div class="text-center">
                        </div>
                        <h1 class="app-page-title mb-4 ">เปลี่ยนรหัสผ่าน</h1>
                        <form action="" method="POST" enctype="multipart/form-data" id="form_con">
                            <hr class="mb-3 mt-4">
                            <div class="mb-3">
                                <label class="form-label">รหัสผ่านเก่า </label>
                                <input type="password" class="form-control" placeholder="รหัสผ่านเก่า" name="oldpassword" id="oldpass" >
                                <span class="text-danger" id="alert_oldpass"></span>
                              
                            </div>
                            <div class="mb-3">
                                <label class="form-label">รหัสผ่านใหม่ </label>
                                <input type="password" class="form-control" placeholder="รหัสผ่านใหม่" name="newpassword" id="newpass">
                                <span class="text-danger" id="alert_newpass"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ยืนยันรหัสผ่านใหม่ </label>
                                <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่านใหม่" name="confirmnewpassword"id="connewpass" >
                                <span class="text-danger" id="alert_connewpass"></span>
                            </div>
                            <div>
                                <input type="hidden" name="changpassword">
                                <input type="button" class="btn btn-primary" onclick="updatepass()" value="ยืนยันการเปลี่ยนรหัสผ่าน">
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function updatepass() {

        var oldpass = $('#oldpass').val();
        var newpass = $('#newpass').val();
        var connewpass = $('#connewpass').val();
      
        if (oldpass == '') {
            $('#alert_oldpass').html('กรุณากรอกรหัสผ่านเก่า');
        }
        if (newpass == '') {
            $('#alert_newpass').html('กรุณากรอกรหัสผ่านใหม่');
        }
        if (connewpass == '') {
            $('#alert_connewpass').html('กรุณากรอกรหัสผ่านใหม่');
        }

        if (oldpass != '' & newpass != '' & connewpass != '') {
            Swal.fire({
                title: 'ยืนยันการเปลี่ยนรหัสผ่าน',

                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',

            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'เปลี่ยนรหัสผ่านสำเร็จ!',
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
</div>

<?php require_once('include/footer.php'); ?>