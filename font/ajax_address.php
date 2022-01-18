<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php
if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `district` WHERE ProvinceID = '$id' ";
    $query =mysqli_query($connection, $sql);
    echo '<option selected disabled>กรุณาเลือกอำเภอ</option>';
    foreach($query as $value){
        echo '<option value="'.$value['DistrictID'].'">'.$value['DistrictName'].'</option>';
    }
    exit();
}


if (isset($_POST['function']) && $_POST['function'] == 'amphures') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `tambon` WHERE DistrictID = '$id' ";
    $query = mysqli_query($connection, $sql);
    echo '<option selected disabled>กรุณาเลือกตำบล</option>';
    foreach ($query as $value) {
        echo '<option value="' . $value['TambonID'] . '">' . $value['TambonName'] . '</option>';
    }
    exit();
}

if (isset($_POST['function']) && $_POST['function'] == 'districts') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `tambon` WHERE TambonID = '$id' ";
    $query = mysqli_query($connection,$sql);
    $result = mysqli_fetch_assoc($query);
        echo $result['zipcode'];
        exit();
    }




    



?>