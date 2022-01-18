<?php require_once('connection/conn.php') ?>

<?php
if (isset($_GET['del_cart'])) {
    $data = [
        'id' => $_GET['del_cart']
    ];
    try {
        $sql = "DELETE FROM tb_cart WHERE id_cart =:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        Header("Location:Cart.php");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}
$data = [
    'id' => $_POST['id']
];

try {
    $sql = "DELETE FROM tb_cart WHERE productID =:id";
    $query = $conn->prepare($sql);
    $query->execute($data);
    header("Refresh:1; url=Cart.php");
} catch (PDOException $e) {
    echo 'ลบไม่สำเร็จ' . $e->getMessage();
}



?>