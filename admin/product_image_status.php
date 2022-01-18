<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php


    if ($_POST['status_image_product'] == 1) {
        $data = [

            'status_image_product' => $_POST['status_image_product'],
            'id_product_image' => $_POST['id_product_image'],
            'id_product' => $_POST['id_product'],

        ];

        $sql = "UPDATE tb_product_image SET statusimage =:status_image_product WHERE id_product_image = :id_product_image  AND tb_product_id=:id_product";
        $query = $conn->prepare($sql);
        $query->execute($data);

        $data2 = [

            'status_image_product' => 0,
            'id_product_image' => $_POST['id_product_image'],
            'id_product' => $_POST['id_product'],

        ];

        $sql = "UPDATE tb_product_image SET statusimage =:status_image_product WHERE id_product_image != :id_product_image  AND tb_product_id=:id_product";
        $query = $conn->prepare($sql);
        $query->execute($data2);

        Header("Location:product_update.php?id=" . $_GET['idproduct']);
    }

?>


