<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<!DOCTYPE html>
<?php
$sql1 = "SELECT * FROM tb_color";
$sql = "SELECT * FROM tb_type_product";
$sql2 = "SELECT * FROM tb_size";
$result_type_product = mysqli_query($connection, $sql);
$result_color = mysqli_query($connection, $sql1);
$result_size = mysqli_query($connection, $sql2);
$sql = "SELECT * FROM tb_product";
if (isset($_GET['type_product_id']) && !empty($_GET['type_product_id'])) {
    $sql .= " WHERE type_product_id ='" . $_GET['type_product_id'] . "'";
}
if (isset($_GET['tb_color_id']) && !empty($_GET['tb_color_id'])) {
    $sql .= " WHERE tb_color_id ='" . $_GET['tb_color_id'] . "'";
}
if (isset($_GET['tb_size_id']) && !empty($_GET['tb_size_id'])) {
    $sql .= " WHERE tb_size_id ='" . $_GET['tb_size_id'] . "'";
}
$result_product = mysqli_query($connection, $sql);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../font/assets/style.css">
    <link rel="stylesheet" href="../font/assets/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <title>รายการสินค้า</title>
</head>

<body>
    <?php require_once('include/header.php'); ?>

    <div class="container">
        <div class="text-center my-3">
            <h1>รายการสินค้า</h1>
        </div>
        <div class="row">
            <div class="col-3">
                <hr class="mb-3 mt-4">
                <a class="link-dark nav-link " href="type_product.php">
                    สินค้าทั้งหมด
                </a>
                <div class="item">
                    <a class="sub-btn nav-link link-dark">ประเภทสินค้า<i class="fas fa-angle-right dropdown float-end"></i></a>
                    <div class="sub-menu">
                        <?php foreach ($result as $row) { ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector title_type" value="<?php echo $row['title_type']; ?>"> <?php echo $row['title_type']; ?></label>
                            </div>

                        <?php } ?>
                    </div>
                </div>
                <div class="item">
                    <a class="sub-btn nav-link link-dark">สี<i class="fas fa-angle-right dropdown float-end"></i></a>
                    <div class="sub-menu">
                        <?php foreach ($result_size as $row) { ?>
                            <a class="link-dark nav-link " href="?tb_size_id=<?php echo $row['id'] ?>">
                                <?php echo $row['title_size']; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="item">
                    <a class="sub-btn nav-link link-dark">ไซด์<i class="fas fa-angle-right dropdown float-end"></i></a>
                    <div class="sub-menu">
                        <?php foreach ($result_color as $row) { ?>
                            <a class="link-dark nav-link" href="?tb_color_id=<?php echo $row['id'] ?>">
                                <?php echo $row['title_color']; ?>
                            </a>
                        <?php } ?>

                    </div>
                </div>

            </div>

            <div class="col-9">
                <div class="row">
                    <?php foreach ($result_product as $row) { ?>
                        <div class="col-12 col-lg-4 my-2">
                            <form action="" method="">
                                <div class="card">
                                    <img class="img2" src="../admin/upload/product/<?php echo $row['image'] ?>" width="auto" height="300">
                                    <div class="card-body">
                                        <p class="card-text text-center"><?php echo $row['title']; ?></p>
                                        <h5 class="card-title text-center">&#3647;<?php echo number_format($row['price']); ?></h5>
                                        <div class="text-center text-dark "> <button class="myBtn"><i class="fas fa-shopping-bag"></i>
                                                เพิ่มเข้ารถเข็น</button>
                                        </div>

                            </form>
                        </div>
                </div>

            </div>
        <?php  } ?>

        </div>
    </div>
    </div>



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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once('include/footer.php'); ?>
</body>

</html>