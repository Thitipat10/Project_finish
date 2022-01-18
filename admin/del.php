<?php require_once('connection/conn.php') ?>

<?php
// user
if (isset($_GET['del_user'])) {
    $data = [
        'id' => $_GET['del_user']
    ];
    try {
        $sql = "DELETE FROM tb_admin WHERE id=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;
        Header("Location:admin.php?");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}
// product
// if (isset($_GET['del_product'])) {
//     $data = [
//         'id' => $_GET['del_product']
//     ];
//     try {
//         $sql = "DELETE FROM tb_product WHERE id_product=:id";
//         $query = $conn->prepare($sql);
//         $query->execute($data);
//         $_SESSION['m'] = 1;
//         Header("Location:product.php");
//     } catch (PDOException $e) {
//         echo 'ลบไม่สำเร็จ' . $e->getMessage();
//     }
// }

if (isset($_GET['onproduct'])) {
    $data = [
        'id' => $_GET['onproduct'],
        'status' => 0
    ];
    try {
        $sql = "UPDATE tb_product SET status=:status WHERE id_product=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;
        Header("Location:product.php");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}
if (isset($_GET['offproduct'])) {
    $data = [
        'id' => $_GET['offproduct'],
        'status' => 1
    ];
    try {
        $sql = "UPDATE tb_product SET status=:status WHERE id_product=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;
        Header("Location:product.php");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}

// type_product
if (isset($_GET['off_type'])) {
    $data = [
        'id' => $_GET['off_type'],
        'status' => 1
    ];
    try {
        $sql = "UPDATE tb_type_product SET status=:status WHERE id_type_product=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;
        Header("Location:type_product.php");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}
if (isset($_GET['on_type'])) {
    $data = [
        'id' => $_GET['on_type'],
        'status' => 0
    ];
    try {
        $sql = "UPDATE tb_type_product SET status=:status WHERE id_type_product=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;
        Header("Location:type_product.php");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}

if (isset($_GET['del_product_image'])) {
    $data = [
        'id' => $_GET['del_product_image']
    ];
    try {
        $sql = "DELETE FROM tb_product_image WHERE id_product_image=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;

        Header("Location:product_update.php?id=" . $_GET['idproduct']);
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}
if (isset($_GET['off_payment'])) {
    $data = [
        'id' => $_GET['off_payment'],
        'status' => 1
    ];
    try {
        $sql = "UPDATE tb_payment SET pay_status=:status WHERE id_payment=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;
        Header("Location:payment.php");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}

if (isset($_GET['on_payment'])) {
    $data = [
        'id' => $_GET['on_payment'],
        'status' => 0
    ];
    try {
        $sql = "UPDATE tb_payment SET pay_status=:status WHERE id_payment=:id";
        $query = $conn->prepare($sql);
        $query->execute($data);
        $_SESSION['m'] = 1;
        Header("Location:payment.php");
    } catch (PDOException $e) {
        echo 'ลบไม่สำเร็จ' . $e->getMessage();
    }
}
?>



