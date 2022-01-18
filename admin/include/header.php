<!-- Page Wrapper -->
<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
// echo $url;

?>
<?php
$sql = "SELECT * FROM tb_orders WHERE  status = 1 ORDER BY OrderID DESC";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
?>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SiraonAdmin <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item  <?php echo ($url == "index.php" ? "active" : "") ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-home"></i>
                <span>หน้าหลัก</span></a>
        </li>
        <li class="nav-item <?php echo ($url == "about.php" ? "active" : "") ?>">
            <a class="nav-link" href="about.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>จัดการข้อมูลเกี่ยวกับฉัน</span></a>
        </li>

        <li class="nav-item <?php echo ($url == "admin.php" ? "active" : "") ?> ">
            <a class="nav-link " href="admin.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>จัดการข้อมูลผู้ดูแลระบบ</span></a>
        </li>
        <li class="nav-item <?php echo ($url == "member.php" ? "active" : "") ?> ">
            <a class="nav-link " href="member.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>จัดการข้อมูลสมาชิก</span></a>
        </li>
        <li class="nav-item <?php echo ($url == "payment.php" ? "active" : "") ?> ">
            <a class="nav-link " href="payment.php">
                <i class="fas fa-money-bill-wave-alt"></i>
                <span>รูปแบบการชำระเงิน</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Interface
        </div> -->
        <li class="nav-item  <?php echo ($url == "product.php" ? "active" : "") ?> <?php echo ($url == "type_product.php" ? "active" : "") ?>">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>จัดการข้อมูลสินค้า</span>
            </a>
            <div id="collapseTwo" class="collapse <?php echo ($url == "product.php" ? "show" : "") ?> <?php echo ($url == "type_product.php" ? "show" : "") ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">


                    <a class="collapse-item <?php echo ($url == "product.php" ? "active" : "") ?>" href="product.php"> จัดการข้อมูลสินค้า</a>
                    <a class="collapse-item <?php echo ($url == "type_product.php" ? "active" : "") ?>" href="type_product.php">จัดการประเภทสินค้า</a>
                </div>
            </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item  <?php echo ($url == "payment_list.php" ? "active" : "") ?> <?php echo ($url == "delivery_list.php" ? "active" : "") ?>">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>คำสั่งซื้อสินค้า
                    <?php if (!empty(mysqli_num_rows($query))) { ?>
                        <span class="badge badge-danger"> <?php echo mysqli_num_rows($query); ?></span></span>
            <?php } ?>
            </a>
            <div id="collapseTwo2" class="collapse <?php echo ($url == "payment_list.php" ? "show" : "") ?> <?php echo ($url == "delivery_list.php" ? "show" : "") ?> <?php echo ($url == "record_list.php" ? "show" : "") ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                    <a class="collapse-item <?php echo ($url == "record_list.php" ? "active" : "") ?>" href="record_list.php">ประวัติการสั่งซื้อ</a>
                    <a class="collapse-item <?php echo ($url == "payment_list.php" ? "active" : "") ?>" href="payment_list.php"> รายการชำระเงิน</a>
                    <a class="collapse-item <?php echo ($url == "delivery_list.php" ? "active" : "") ?>" href="delivery_list.php">รายการจัดส่ง</a>

                </div>
            </div>
        </li>




        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->


        <!-- Nav Item - Pages Collapse Menu -->

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>



    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->


                    <!-- Nav Item - Alerts -->

                    <!-- Nav Item - Messages -->
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <?php
                    if (!empty($_SESSION['id'])) {
                    ?>
                        <li class="nav-item dropdown no-arrow ">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['user']; ?></span>
                                <img src="upload/admin/<?php echo $_SESSION['image']; ?>" alt="" width="100px" hight="100px" class="img-profile rounded-circle">


                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                           
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="../font/login.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                 ออกจากระบบ
                                </a>

                            </div>
                        </li>


                    <?php  } ?>


                    <!-- Nav Item - User Information -->


                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->

            <!-- /.container-fluid -->


            <!-- End of Main Content -->

            <!-- Footer -->

            <!-- End of Footer -->


            <!-- End of Content Wrapper -->


            <!-- End of Page Wrapper -->