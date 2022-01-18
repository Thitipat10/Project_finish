<?php


require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php');
$sql = "SELECT  * , sum(c.qty) as SUM FROM tb_cart as c 
INNER JOIN tb_size as s ON c.tb_size_id2 = s.id_size
INNER JOIN tb_color as o ON c.tb_color_id2 = o.id_color
INNER JOIN tb_product as p ON c.productID = p.id_product 
WHERE c.status = 1 AND c.user = '" . @$_SESSION['id'] .  "'
GROUP BY c.productID";
$rowcart = mysqli_query($connection, $sql);
$resutl = mysqli_fetch_all($rowcart);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../font/assets/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

<?php

require_once('include/header.php');

?>
<div class="bg-22"></div>
<?php
if (mysqli_num_rows($rowcart) == 0) { ?>

    <div class="col-md-4 mx-auto">
        ไม่มีรายการสินค้า
    </div>
<?php }
?>
<?php
if (mysqli_num_rows($rowcart) !== 0) { ?>


    <div id="lode"></div>
<?php }
?>
<script>
    $(document).ready(function() {
        $('#lode').load('ajax_cart2.php')
    });
</script>
<?php require_once('include/footer.php'); ?>
<!-- The result of the search will be rendered inside this div -->
<div id="result"></div>