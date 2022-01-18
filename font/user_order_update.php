<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php

if (isset($_POST) && !empty($_POST)) {
    // print_r($_POST);

    
    $status = 6;
    $OrderID = $_POST['OrderID'];
   

    $sqlnumber = "UPDATE tb_orders SET status='$status'  WHERE OrderID = $OrderID";
    $querynumber = mysqli_query($connection, $sqlnumber);

    Header("Location:user_order.php");
}

?>

