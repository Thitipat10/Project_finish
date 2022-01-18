<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php
// quert_product


$sql = "SELECT  * FROM tb_product as p 
INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
INNER JOIN tb_color as o ON p.tb_color_id = o.id_color
INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product WHERE number != 0 AND status=0";
$result_product = mysqli_query($connection, $sql);

// $sqlProdct = "SELECT  * FROM tb_product ORDER BY id DESC LIMIT 6";
// $queryProduct = $conn->prepare($sqlProdct);
// $queryProduct->execute();
// $result_product = $queryProduct->fetchAll(PDO::FETCH_ASSOC);



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
<?php

?>

<body class="">
    <?php require_once('include/header.php'); ?>

    <div class="bg-22"></div>
    <div class="container mt-4 my-5 ">
        <div class="mb-3 ">
            <h2 class="text-center">วิธีการสั่งซื้อ</h2>
            <div class="text-center my-3">
                ช้อปปิ้งที่ Sira-on Shop สะดวกมาก ขั้นตอนมีดังนี้:
            </div>

            <div class="row mt-5">
                <div class="col-6 ">
                    <h3> ขั้นตอนที่ 1</h3>
                    <h3> เข้าสู่บัญชี Sira-on Shop</h3>
                    หากคุณมีบัญชี Sira-on Shop แล้วโปรดเลือก "เข้าสู่ระบบ"
                    <br>
                    หากยังไม่มีให้เลือก "สมัครใหม่"
                </div>
                <div class="col-6">
                    <img src="../admin/upload/test/1.png" alt="" width="600" hight="600" class=""></img>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-6 ">
                    <h3> ขั้นตอนที่ 2</h3>
                    <h3>เพิ่มในรถเข็น</h3>
                    เลือกดูสินค้าทที่สนใจแล้ว
                    <br>
                    คลิกที่ "เพิ่มในรถเข็น"
                </div>
                <div class="col-6">
                    <img src="../admin/upload/test/2_1.png" alt="" width="300" hight="300" class=""></img>
                    <img src="../admin/upload/test/2_2.png" alt="" width="300" hight="300" class=""></img>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-6 ">
                    <h3> ขั้นตอนที่ 3</h3>
                    <h3>สั่งซื้อ</h3>
                    1. คลิกที่ปุ่ม "ดูรถเข็น" เพื่อดูรายการที่เพิ่ม หากมีความต้องการ ก็ทำการแก้ไขได้
                    <br>
                    2. หากไม่มีที่อยู่ให้ "เพิ่มที่อยู่จัดส่ง"
                    <br>
                    3. "กดสั่งซื้อสินค้า" เพื่อทำการสั่งซื้อ
                    คลิกที่ "เพิ่มในรถเข็น"
                </div>
                <div class="col-6">
                    <img src="../admin/upload/test/3.png" alt="" width="700" hight="800" class=""></img>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-6 ">
                    <h3> ขั้นตอนที่ 4</h3>
                    <h3>ชำระเงิน</h3>
                    หากต้องการชำระเงินให้ กดปุ่ม "แนบสลิป"
                    <br>
                    หากยังไม่ต้องการชำระเงินให้กดปุ่ม "ชำระเงินภายหลัง"
                    <br>
                  
                </div>
                <div class="col-6">
                    <img src="../admin/upload/test/4.png" alt="" width="600" hight="600" class=""></img>
                </div>
            </div>
        </div>
    </div>


    </form>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="assets/bot.js"></script>
    <script scr="../font/assets/slick.js"></script>
    <script scr="../font/assets/jquery.js"></script>
    <!-- slic -->



    <?php
    echo '<script> src="https://code.jquery.com/jquery-3.6.0.min.js"</script>
        <script> src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"</script>';


    ?>
    <?php require_once('include/footer.php'); ?>
</body>

</html>