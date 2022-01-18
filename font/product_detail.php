<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<!DOCTYPE html>
<?php
$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$sql = "SELECT * FROM tb_product as p
JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
JOIN tb_size as s ON p.tb_size_id =s.id_size
JOIN tb_color as c ON p.tb_color_id = c.id_color

";
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql .= "WHERE p.id_product='$id' ORDER BY p.id_product ASC";
}


$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);
$idpro = $row['id_product'];
$sqlProdct = "SELECT  * FROM tb_product WHERE status = 0 ORDER BY id_product DESC LIMIT 4 ";
$result_product = mysqli_query($connection, $sqlProdct);

?>
<?php

$sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                             WHERE tt.tb_product_id = '$idpro' ORDER BY tt.statusimage DESC";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);

?>
<html lang="en">

<style>
    span {
        cursor: pointer;
    }

    .number {
        margin: 100px;
    }

    .minus,
    .plus {
        width: 20px;
        height: 20px;
        background: #f2f2f2;
        border-radius: 4px;
        padding: 8px 5px 8px 5px;
        border: 1px solid #ddd;
        display: inline-block;
        vertical-align: middle;
        text-align: center;
    }

    input {
        height: 34px;
        width: 100px;
        text-align: center;
        font-size: 26px;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: inline-block;
        vertical-align: middle;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../font/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <title>รายการสินค้า</title>
</head>
<link rel="stylesheet" href="assets/jquery.nice-number.css">

<body>
    <?php require_once('include/header.php'); ?>

    <div class="container">

        <div class="row">
            <div class="text-center my-5">
                <h1>รายละเอียดสินค้า</h1>
            </div>
            <div class="col-5 mx-2">
                <section class="slider-for ">
                    <?php foreach ($query as $row2) { ?>
                        <div class=" image-sizetop"> <img class="text-center center-img" src="../admin/upload/product/<?php echo $row2['image'] ?>"></div>

                    <?php } ?>

                </section>
                <br>
                <section class="slider-nav">
                    <?php foreach ($query as $row2) { ?>
                        <div class="image-sizebottom"> <img class="text-center center-img" src="../admin/upload/product/<?php echo $row2['image'] ?>"></div>
                    <?php } ?>
                </section>
            </div>
            <div class="col-5 ms-5">
                <form action="insertCart.php?id=<?php echo $id ?>" method="post">
                    <input type="hidden" name="url" value="<?php echo $url ?>">
                    <input type="hidden" name="ProductID" value="<?php echo $row['id_product'] ?>">
                    <input type="hidden" name="user" value="<?php echo @$_SESSION['id'] ?>">
                    <input type="hidden" name="tb_size_id2" value="<?php echo $row['tb_size_id'] ?>">
                    <input type="hidden" name="tb_color_id2" value="<?php echo $row['tb_color_id'] ?>">
                    <h1><?php echo $row['title'] ?> </h1>
                    <hr>


                    <h1 class="text-danger" for=""> &#3647;<?php echo number_format($row['price']); ?></h1>

                    <div class="row">
                        <div class="col-2"> <label for=""> หมวดหมู่ </label></div>
                        <div class="col-8"><?php echo $row['title_type']; ?></div>
                        <div class="col-1"></div>
                    </div>
                    <label class="mt-3">
                    </label>

                    <br>
                    <div class="row">
                        <div class="col-2"> <label for=""> ไซส์ </label></div>
                        <div class="col-8"><?php echo $row['title_size']; ?></div>
                        <div class="col-1"></div>
                    </div>
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        คู่มือไซส์
                    </button> -->
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">คู่มือไซส์</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2"> <label for=""> สี </label></div>
                        <div class="col-8"><?php echo $row['title_color']; ?></div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-2">จำนวน<br>
                        </div>
                        <div class="col-8">
                            <form action="insertCart.php" method="POST">
                                <div class="test float-start me-3">
                                    <input type="number" name="qty" id="qty" min="1" max="<?php echo $row['number']; ?>" value="1" class="form-control">
                                </div>

                                <div class="">มีสินค้าทั้งหมด <label><?php echo $row['number']; ?></label> ชิ้น</div>
                        </div>
                        <div class="col-1">

                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-4">
                            <div class="text-center text-dark float-start"> <button class="myBtn" name="addcart"><i class="fas fa-shopping-bag"></i>
                                    เพิ่มเข้ารถเข็น</button>

                            </div>


                        </div>
                </form>
                <div class="col-8">


                    <div class="text-center text-dark float-start "> <button class="myBtn" name="Order">
                            สั่งซื้อ</button>
                    </div>
                    </form>
                </div>


            </div>




        </div>

        <div class="my-5">
            <div class="text-bold">รายละเอียดสินค้า</div>
            <hr>
            <?php echo $row['detail'] ?>
        </div>



    </div>



    <div class="container mt-4 my-5">
        <div class="mb-5 mt-5 text-center">
            <h4>สินค้าอื่น ๆ</h4>
        </div>
        <div class="row">
            <?php foreach ($result_product as $row) { ?>
                <?php

                $sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                             WHERE  statusimage = 1 AND tt.tb_product_id = '" . $row['id_product'] . "'";
                $query = mysqli_query($connection, $sql);
                $result = mysqli_fetch_assoc($query);

                ?>
                <div class="col-12 col-lg-3">
                    <form action="insertCart.php" method="POST">
                        <a class="text-dark" href='product_detail.php?id=<?php echo $row['id_product'] ?>'>
                            <div class="card ">

                                <img class="img2" src="../admin/upload/product/<?php echo $result['image'] ?>" width="300" height="300">
                                <div class="card-body ">
                                    <p class="card-text text-over"><?php echo $row['title']; ?></p>

                                    <h5 class="card-title text-orage h5 mt-2 mb-3">&#3647;<?php echo number_format($row['price']); ?></h5>

                                    <!-- <div class="text-center text-dark "> <button class="myBtn"><i class="fas fa-shopping-bag"></i>
                                            เพิ่มเข้ารถเข็น</button>
                                    </div> -->

                                    <input type="hidden" name="qty" value="1">

                                    <input type="hidden" name="url" value="<?php echo $url ?>">
                                    <input type="hidden" name="ProductID" value="<?php echo $row['id_product'] ?>">
                                    <input type="hidden" name="user" value="<?php echo @$_SESSION['id'] ?>">
                                    <input type="hidden" name="tb_size_id2" value="<?php echo $row['tb_size_id'] ?>">
                                    <input type="hidden" name="tb_color_id2" value="<?php echo $row['tb_color_id'] ?>">
                        </a>
                    </form>


                </div>

        </div>

    </div>

<?php  } ?>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once('include/footer.php'); ?>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="assets/bot.js"></script>
<script scr="../font/assets/slick.js"></script>
<script scr="../font/assets/jquery.js"></script>
<script src="assets/jquery.nice-number.js"></script>
<!-- <script>
        function prodetail() {
            var data = $('#qty').val();

            $.ajax({
                type: "POST",
                url: insertCart.php,
                data: data
            })
            console.log(data);
        }
    </script> -->
<script>
    $(function() {

        $('input[type="number"]').niceNumber();

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

?>
<script>
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });
</script>

</body>

</html>