<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php
// quert_product

$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$sql = "SELECT  * FROM tb_product as p 
INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
INNER JOIN tb_color as o ON p.tb_color_id = o.id_color
INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product WHERE p.number != 0 AND p.status=0 ORDER BY p.id_product DESC LIMIT 6";

$result_product = mysqli_query($connection, $sql);

// $sqlProdct = "SELECT  * FROM tb_product ORDER BY id DESC LIMIT 6";
// $queryProduct = $conn->prepare($sqlProdct);
// $queryProduct->execute();
// $result_product = $queryProduct->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * ,
        SUM(od.Qty) as sumqty
        FROM tb_product   as p 
        INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
        INNER JOIN tb_color as c ON p.tb_color_id = c.id_color
        INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
        INNER JOIN tb_orders_detail as od ON p.id_product = od.ProductID
        INNER JOIN tb_orders as o ON od.OrderID = o.OrderID
        WHERE o.status >=3 AND p.number != 0 
        GROUP BY p.id_product ORDER BY sumqty DESC LIMIT 5
        
        ";
$query2 = $conn->prepare($sql2);
$query2->execute();
$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../font/assets/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <title>Sira-on Shop</title>
</head>

<div class="top-btn">
    <i class="fas fa-arrow-up"></i>
</div>

<body class="">
    <?php require_once('include/header.php'); ?>
   
    <img src="../admin/upload/test/banner.png" alt="" width="100% " height="650px">
    <div class="bg-22"></div>
    <div class="container mt-4 my-5">
        <div class="my-5 text-center">
            <h4>สินค้าใหม่</h4>
        </div>
        <div class="row">
            <section class="responsive">
                <?php foreach ($result_product as $row) { ?>
                    <?php
                    $sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                             WHERE statusimage = 1  AND tt.tb_product_id = '" . $row['id_product'] . "'";
                    $query = mysqli_query($connection, $sql);
                    $result = mysqli_fetch_assoc($query);

                    ?>
                    <div class="col-12 col-lg-3 ">
                        <form action="insertCart.php" method="POST">
                            <a class="text-dark " href='product_detail.php?id=<?php echo $row['id_product'] ?>'>
                                <div class="card cardddd " style="width: 18rem; height:420px;" herf=''>
                                    <img class="img2 card-img-top" src="../admin/upload/product/<?php echo $result['image'] ?>" width="300" height="300">
                                    <div class="card-body">
                                        <h5 class="card-title text-over"><?php echo $row['title']; ?></h5>
                                        <p class="card-text text-orage h5 mt-2 mb-3">&#3647;<?php echo number_format($row['price']); ?></p>

                                        <a href="product_detail.php?id=<?php echo $row['id_product']; ?>"></a>
                                        <!-- <i class="fas fa-shopping-bag"> -->

                                        <!-- <div class="text-center text-dark "> <button class="myBtn"><i class="fas fa-shopping-bag"></i>
                                                เพิ่มเข้ารถเข็น</button>
                                        </div> -->
                                        <br>
                                        <input type="hidden" name="url" value="<?php echo $url ?>">
                                        <input type="hidden" name="ProductID" value="<?php echo $row['id_product'] ?>">
                                        <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="user" value="<?php echo @$_SESSION['id'] ?>">
                                        <input type="hidden" name="tb_size_id2" value="<?php echo $row['tb_size_id'] ?>">
                                        <input type="hidden" name="tb_color_id2" value="<?php echo $row['tb_color_id'] ?>">
                            </a>
                        </form>
                    </div>
        </div>
    </div>
<?php  } ?>

</form>
</section>
<div class="my-5 text-center">
    <h4>สินค้าขายดี</h4>
</div>
<div class="row">
    <section class="responsive">
        <?php foreach ($result2 as $row) { ?>
            <?php


            $sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                             WHERE statusimage = 1  AND tt.tb_product_id = '" . $row['id_product'] . "'";
            $query = mysqli_query($connection, $sql);
            $result = mysqli_fetch_assoc($query);



            ?>
            <div class="col-12 col-lg-3 ">
                <form action="insertCart.php" method="POST">
                    <a class="text-dark " href='product_detail.php?id=<?php echo $row['id_product'] ?>'>
                        <div class="card cardddd " style="width: 18rem; height:420px" herf=''>
                            <img class="img2 card-img-top" src="../admin/upload/product/<?php echo $result['image'] ?>" width="300" height="300">
                            <div class="card-body">
                                <h5 class="card-title text-over"><?php echo $row['title']; ?></h5>
                                <p class="card-text text-orage  h5 mt-2 mb-3">&#3647;<?php echo number_format($row['price']); ?></p>

                                <a href="product_detail.php?id=<?php echo $row['id_product']; ?>"></a>
                                <!-- <i class="fas fa-shopping-bag"> -->
                                <!-- 
                                <div class="text-center text-dark "> <button class="myBtn"><i class="fas fa-shopping-bag"></i>
                                        เพิ่มเข้ารถเข็น</button>
                                </div> -->
                                <br>
                                <input type="hidden" name="url" value="<?php echo $url ?>">
                                <input type="hidden" name="ProductID" value="<?php echo $row['id_product'] ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="user" value="<?php echo @$_SESSION['id'] ?>">
                                <input type="hidden" name="tb_size_id2" value="<?php echo $row['tb_size_id'] ?>">
                                <input type="hidden" name="tb_color_id2" value="<?php echo $row['tb_color_id'] ?>">
                    </a>
                </form>
            </div>
</div>
</div>
<?php  } ?>

</form>
</section>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="assets/bot.js"></script>
<script scr="../font/assets/slick.js"></script>
<script scr="../font/assets/jquery.js"></script>

<script>
    $(document).on('ready', function() {
        $(".vertical-center-4").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4
        });
    })
    $('.responsive').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [{
                breakpoint: 1400,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 770,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
<?php
if (@$_SESSION['m'] == 1) {
    echo "<script>
        Swal.fire({
            position: '',
            icon: 'success',
            title: 'เพิ่มเข้าไปในกระเป๋าสำเร็จแล้ว',
            showConfirmButton: false,
            timer: 1500
          })
        </script>   ";

    unset($_SESSION['m']);
}
?>


<?php
echo '<script> src="https://code.jquery.com/jquery-3.6.0.min.js"</script>
        <script> src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"</script>';


?>
<?php require_once('include/footer.php'); ?>
</body>

</html>