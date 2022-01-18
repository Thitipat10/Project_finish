<?php
require_once('connection/conn.php');
require_once('connection/connection.php');


if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
    
    $extension = array("jpeg", "jpg", "png");
    //ประเภทไฟล์
    $target = '../admin/upload/payment_orders/';
    //ไฟล์ที่จะเก็บรูปภาพ
    $filename = $_FILES['image']['name'];
    $filetmp = $_FILES['image']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // เรียกไฟล์เฉพาะ.
    //echo $ext;
    if (in_array($ext, $extension)) {
        if (!file_exists($target . $filename)) {  // ไม่มีชื่อไฟล์ซ้ำ
            if (move_uploaded_file($filetmp, $target . $filename)) {
                $filename = $filename;
            } else {
                echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
            }
        } else {
            $newfilename = time() . $filename;
            if (move_uploaded_file($filetmp, $target . $newfilename)) {
                $filename = $newfilename;
            } else {
                echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
            }
        }
    } else {
        echo 'ประเภทไฟล์ไม่ถูกต้อง';
    }
} else {
    $filename = '';
}



$data = [
    'OrderID' => $_POST['OrderID'],
    'id_bank' => $_POST['payment'],
    'date' => $_POST['date'],
    'time' => $_POST['time'],
    'filename' => $filename,

];



$sql = "UPDATE tb_payment_orders SET id_order=:OrderID,id_bank=:id_bank,date=:date,time=:time,image_pm=:filename WHERE id_order=:OrderID" ;
$query = $conn->prepare($sql);
$query->execute($data);



$data2 = [
    'OrderID' => $_POST['OrderID'],
    'status' => 1
];



$sql = "UPDATE tb_orders SET status=:status WHERE OrderID=:OrderID";
$query = $conn->prepare($sql);
$query->execute($data2);




Header("Location:user_order.php")
