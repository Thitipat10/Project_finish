<?php require_once('connection/conn.php'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../font/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Custom styles for this template-->
    <link href="../admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="">
    <nav class="navbar  navbar-expand-lg bg-header2 py-5">
        <div class="container ">
            <a class=" fonticon logo-text text-white" href="index.php">Sira-on Shop</a>
        </div>
    </nav>
    <?php
    if (@$_SESSION['login'] == 2) {
        echo "<script>
        Swal.fire({
            position: '',
            icon: 'error',
            title: 'เข้าสู่ระบบผิดพลาด',
            showConfirmButton: false,
            timer: 1500
          })
        
        
        
        </script>   ";
        unset($_SESSION['login']);
    }

    ?>
        <?php
    if (@$_SESSION['login'] == 3) {
        echo "<script>
        Swal.fire({
            position: '',
            icon: 'error',
            title: 'ไอดีผู้ใช้งานของผู้ถูกระชำโปรดติดต่อผู้ดูแลระบบ',
            showConfirmButton: false,
            timer: 1500
          })
        
        
        
        </script>   ";
        unset($_SESSION['login']);
    }

    ?>

<?php
    if (@$_SERVER['register'] == 1) {
        echo "<script>
        Swal.fire({
            position: '',
            icon: 'success',
            title: 'สมัครสำเร็จ',
            showConfirmButton: false,
            timer: 1500
          })
        </script>   ";

        unset($_SERVER['register']);
    }
    ?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">เข้าสู่ระบบ</h1>
                                    </div>
                                    <form action="login_check.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="user" placeholder="ชื่อผู้ใช้">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="รหัสผ่าน" name="pass">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">จดจำฉัน</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">ยืนยัน</button>
                                        <hr>

                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">ลืมรหัสผ่าน</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="register.php">สมัครใหม่</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <?php require_once('include/footer.php'); ?>
</body>

</html>