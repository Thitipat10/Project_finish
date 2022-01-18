<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php

if (@!empty($_POST['firstname2'])) {

    $firstname = $_POST['firstname2'];
    $lastname = $_POST['lastname2'];
    $phone = $_POST['phone2'];
    $province = $_POST['province2'];
    $amphures = $_POST['amphures2'];
    $districts = $_POST['districts2'];
    $zipcode = $_POST['zipcode2'];
    $address_details = $_POST['address_details2'];
    $user = $_SESSION['id'];
    $id_address_up = $_POST['id_address_up'];

    $sql2 = "UPDATE tb_address SET firstname = '$firstname', 
                                lastname = '$lastname',
                                phone = '$phone',
                                province = '$province',
                                amphures = '$amphures',
                                districts = '$districts',
                                zipcode = '$zipcode', 
                                address_details = '$address_details'
 WHERE user= '$user ' AND  id_address ='$id_address_up' ";
    $query2 = mysqli_query($connection, $sql2);

    Header("Location:address.php");
}


if (@!empty($_POST['firstname'])) {
 
 
        $data = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'phone' => $_POST['phone'],
            'province' => $_POST['province'],
            'amphures' => $_POST['amphures'],
            'districts' => $_POST['districts'],
            'zipcode' => $_POST['zipcode'],
            'address_details' => $_POST['address_details'],
            'user' => $_SESSION['id'],
            'status' => 1


        ];

        $sql1 = "INSERT INTO tb_address (firstname,lastname,phone,province,amphures,districts,zipcode,address_details,user,status) 
                VALUES  (:firstname,:lastname,:phone,:province,:amphures,:districts,:zipcode,:address_details,:user,:status)";
        $query = $conn->prepare($sql1);
        $query->execute($data);

  
  
}

if (@$_POST['status0'] == 0) {
    $data3 = [
        'id' => $_SESSION['id'],
    ];

    $sqladdress = "SELECT * FROM tb_address WHERE user=:id ORDER BY id_address DESC LIMIT 1 ";
    $query = $conn->prepare($sqladdress);
    $query->execute($data3);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $data8 = [

        'status' => $_POST['status0'],
        'id_address' => $result[0]['id_address'],
        'id' => $_SESSION['id'],

    ];

    $sql2 = "UPDATE tb_address SET status =:status WHERE id_address = :id_address  AND user=:id";
    $query = $conn->prepare($sql2);
    $query->execute($data8);

    $data9 = [

        'status' => 1,
        'id_address' => $result[0]['id_address'],
        'id' => $_SESSION['id'],
    ];

    $sql3 = "UPDATE tb_address SET status =:status WHERE id_address != :id_address  AND user=:id";
    $query = $conn->prepare($sql3);
    $query->execute($data9);

    Header("Location:address.php");
}



?>
