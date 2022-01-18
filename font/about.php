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

$sql = "SELECT * FROM tb_about";
$query = mysqli_query($connection,$sql);
$result = mysqli_fetch_assoc($query);
?>
<body class="">
    <?php require_once('include/header.php'); ?>
    
    <div class="bg-22"></div>
    <div class="container mt-4 my-5 vh-100">
        <div class="mb-3 ">
     
            <?php echo $result['description']?>

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
echo '<script> src="https://code.jquery.com/jquery-3.6.0.min.js"</script>
        <script> src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"</script>';


?>
<?php require_once('include/footer.php'); ?>
</body>

</html>