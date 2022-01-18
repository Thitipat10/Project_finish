<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php') ?>
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
    if (isset($_POST) && !empty($_POST)) {

        $user = $_POST['user'];
        $pass = md5($_POST['pass']);
        $email = $_POST['email'];
        $role = 'm';
        if (!empty($user)) {
            $sql_check = "SELECT * FROM tb_admin WHERE user = '$user' OR email = '$email'";
            $query_check = mysqli_query($connection, $sql_check);
            $row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
            if ($row_check > 0) {
                echo "<script>
                Swal.fire({
                    position: '',
                    icon: 'error',
                    title: 'ชื่อผู้ใข้งานซ้ำ',
                    showConfirmButton: false,
                    timer: 1500
                  })
                </script>   ";
            } else {
                //echo $filename;
                //exit(); 
                if (!empty($user)) {
                    $sql_check = "SELECT * FROM tb_admin WHERE user = '$user' OR email = '$email'";
                    $query_check = mysqli_query($connection, $sql_check);
                    $row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
                    if ($row_check > 0) {
                        echo 'ชื่อผู้ใช้ซ้ำ กรุณากรอกใหม่อีกครั้ง';
                    }
                }
                $sql = "INSERT INTO tb_admin 
												   (email, user,pass,role)
											VALUES ('$email','$user','$pass','$role')";

               $query_login = mysqli_query($connection, $sql);
               $_SERVER['register'] = 1;
                // $idmember = $connection->insert_id;
                
                    Header("Location:login.php"); 
                // if (!empty($idmember)) {
                //     $sqladmin = "SELECT * FROM tb_admin WHERE ";
                //     $queryadmin = mysqli_query($connection, $queryadmin);
                //     $row = mysqli_fetch_assoc($queryadmin);

                //     echo $row['id'];

                //     // $_SESSION['id'] = $row['id'];
                //     // $_SESSION['user'] = $row['user'];
                //     // $_SESSION['email'] = $row['email'];
                //     // $_SESSION['firstname'] = $row['firstname'];
                //     // $_SESSION['image'] = $row['image'];
              
                // }

         
             
            }
        }


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
                                        <h1 class="h4 text-gray-900 mb-4">สมัครใหม่</h1>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="อีเมล" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="ชื่อผู้ใช้" name="user" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="รหัสผ่าน" name="pass" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">จดจำฉัน
                                                    </label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">ยืนยัน</button>
                                        <hr>
                                    
                                    </form>

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