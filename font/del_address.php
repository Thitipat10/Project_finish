<?php require_once('connection/conn.php') ?>

<?php

$data = [
    'id' => $_GET['id']
];

try {
    $sql = "DELETE FROM tb_address WHERE id_address =:id";
    $query = $conn->prepare($sql);
    $query->execute($data);
    $_SESSION['m'] = 1;
    Header("Location:address.php");
} catch (PDOException $e) {
    echo 'ลบไม่สำเร็จ' . $e->getMessage();
}



?>