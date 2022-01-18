<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php
$data = [

    'id' => $_POST['id'],
    'qty' => 1,

];

$sql = "UPDATE tb_cart SET qty =qty+:qty WHERE ProductID = :id ";
$query = $conn->prepare($sql);
$query->execute($data);

Header("Location:Cart.php");
