<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php

$data = [

    $id = 'id' => $_POST['id'],
    $iduser = 'iduser' => $_SESSION['id'],
    $qty = 'qty' => 1


];
$sql = "UPDATE tb_cart SET qty =qty-:qty WHERE ProductID = :id AND user = :iduser";
$query = $conn->prepare($sql);
$query->execute($data);


Header("Location:Cart.php");
