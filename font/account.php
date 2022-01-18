<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../font/assets/style.css">
    <link rel="stylesheet" href="../font/assets/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <title>ตั้งค่าบัญชี</title>
</head>

<body>
    <?php require_once('include/header.php'); ?>
    <div class="bg-22"></div>
    <div class="container">
        <div class="text-center my-3 ">

        </div>
        <div class="row ">
            <div class="col-2  ">
                <div class="shadow-sm">
                    <ul class="list-group mt-2 ">


                        <div class="item mt-3">
                            <a class="sub-btn nav-link link-dark text-type">
                                <i class="fas fa-user-circle"></i> บัญชีของฉัน<i class="fas fa-angle-right dropdown float-end"></i>
                            </a>
                            <div class="sub-menu ">
                                <div class="<?php echo ($url == "editaccount.php" ? " text-all2" : "") ?>"><a class="" href="editaccount.php"> แก้ไขบัญชี </a></div>
                                <div class=" <?php echo ($url == "changepassword.php" ? " text-all2" : "") ?>"> <a class="nav-link" href="changepassword.php"> เปลี่ยนรหัสผ่าน</a></div>
                                <div class="<?php echo ($url == "address.php" ? " text-all2" : "") ?>"> <a class=" nav-link" href="address.php"> ที่อยู่</a></div>
                            </div>
                        </div>

                    </ul>
                    <ul class="list-group ">
                        <div class="item">
                            <div class="<?php echo ($url == "user_order.php" ? " text-all2" : "") ?>"> <a class="nav-link text-black" href="user_order.php"> <i class="fas fa-pen-square"></i></i> การซื้อของฉัน</a></div>
                        </div>
                    </ul>

                </div>

            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

<script type="text/javascript">
    $(document).ready(function() {
        //jquery for toggle sub menus


        $('.sub-btn').click(function() {

            $(this).next('.sub-menu').slideToggle();
            $(this).find('.dropdown').toggleClass('rotate');
        });

        //jquery for expand and collapse the sidebar
        $('.menu-btn').click(function() {
            $('.side-bar').addClass('active');
            $('.menu-btn').css("visibility", "hidden");
        });

        $('.close-btn').click(function() {
            $('.side-bar').removeClass('active');
            $('.menu-btn').css("visibility", "visible");
        });
    });
</script>

</html>