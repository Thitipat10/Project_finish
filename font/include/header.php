<?php require_once('connection/connection.php');
$sql = "SELECT  * , sum(c.qty) as SUM FROM tb_cart as c 
INNER JOIN tb_product as p ON c.productID = p.id_product
WHERE c.status = 1 AND c.user = '" . @$_SESSION['id'] .  "'
GROUP BY c.productID";
$resutl = mysqli_query($connection, $sql);
$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<nav class="navbar navbar-expand-lg bg-header2 py-5">
    <div class="container ">
        <a class="navbar-brand fonticon logo-text text-white" href="index.php">Sira-on Shop</a>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-header sticky-top">
    <div class="container  bg-border-1">
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-sliders-h"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item btn-or">
                    <a class="nav-link btn-or  <?php echo ($url == "index.php" ? " btn-or2" : "") ?>" aria-current="page" href="index.php">หน้าแรก</a>
                </li>
                <li class="nav-item  btn-or ">
                    <a class="nav-link btn-or <?php echo ($url == "type_product.php" ? " btn-or2" : "") ?>" aria-current="page" href="type_product.php">รายการสินค้า</a>
                </li>
                <li class="nav-item  btn-or">
                    <a class="nav-link btn-or  <?php echo ($url == "about.php" ? " btn-or2" : "") ?>" aria-current="page" href="about.php">ติดต่อเรา</a>
                </li>
            </ul>
            <div class="d-flex ms-auto">
                <!-- <div class="boxSearch ">
                    <div class="input-group">
                        <input type="text" class="form-control bg-search " placeholder="ค้นหาสินค้า..." />
                        <div class="input-group-prepend">

                            <div class="text-center">
                               
                                <i class="fas fa-search"></i>

                            </div>
                        </div>
                    </div>
                </div> -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <div class="dropdown">
                        <?php
                        if (@$_SESSION['id']) { ?>
                            <?php
                            if (!empty($_SESSION['image'])) { ?>
                                <button class="dropbtn "> <img src="../admin/upload/admin/<?php echo $_SESSION['image']; ?>" alt="" width="25px" hight="25px" class="img-profile rounded-circle"></img></button>
                            <?php }
                            ?>
                            <?php
                            if (empty($_SESSION['image'])) { ?>
                                <button class="dropbtn"><img src="../admin/upload/admin/1.png" alt="" width="25px" hight="25px" class="img-profile rounded-circle"></img></button>
                            <?php }
                            ?>
                            <div class="dropdown-content">
                                <a href="editaccount.php">ตั้งค่าบัญชี</a>
                                <a href="logout.php">ออกจากระบบ</a>
                            </div>
                        <?php }
                        ?>
                        <?php
                        if (@!$_SESSION['id']) { ?>
                            <button class="dropbtn"><i class="fas fa-user"></i></button>
                            <div class="dropdown-content ">
                                <a href="login.php">เข้าสู่ระบบ</a>

                                <a href="register.php">สมัครใหม่</a>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="dropdown">
                        <?php
                        if (@$_SESSION['id']) { ?>
                            <a href="Cart.php">
                                <button class="dropbtn"><i class="fas fa-shopping-bag"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php
                                        echo mysqli_num_rows($resutl);
                                        ?>
                                    </span></button>
                            </a>

                        <?php } ?> <?php
                                    if (@!$_SESSION['id']) { ?>
                            <a href="login.php">
                                <button class="dropbtn"><i class="fas fa-shopping-bag"></i>

                            </a>

                        <?php } ?>


                    </div>
                </ul>
            </div>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</nav>