<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php


// echo $_POST['status_address'];
// echo '<br>';
// echo $_POST['user'];
// echo '<br>';
// echo $_POST['id_address'];

$data = [

  
    'id_address' => $_POST['id_address'],
    'user' => $_POST['user'],


];

$sql = "SELECT * FROM tb_address WHERE user=:user AND id_address=:id_address";
$query = $conn->prepare($sql);
$query->execute($data);
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($query->rowCount() == 1) {
    $sql = "SELECT  *  FROM tb_address 
    WHERE  user = '" . $_POST['user'] .  "'";

    $rowcart = mysqli_query($connection, $sql);
    $resutl = mysqli_fetch_assoc($rowcart);

        if($result['status'] == 1){
        $data = [

            'status_address' => $_POST['status_address'],
            'id_address' => $_POST['id_address'],
            'user' => $_POST['user'],

        ];

        $sql = "UPDATE tb_address SET status =:status_address WHERE id_address = :id_address  AND user=:user";
        $query = $conn->prepare($sql);
        $query->execute($data);

        $data2 = [

            'status_address' => 1,
            'id_address' => $_POST['id_address'],
            'user' => $_POST['user'],

        ];

        $sql = "UPDATE tb_address SET status =:status_address WHERE id_address != :id_address  AND user=:user";
        $query = $conn->prepare($sql);
        $query->execute($data2);

        Header("Location:address.php");
 
  
    }

}



if (!empty($_POST['check'])) {
    $data8 = [

        'status' => 0,
        'id_address' => $_POST['check'],
        'id' => $_SESSION['id'],

    ];

    $sql = "UPDATE tb_address SET status =:status WHERE id_address = :id_address  AND user=:id";
    $query = $conn->prepare($sql);
    $query->execute($data8);

    $data9 = [

        'status' => 1,
        'id_address' => $_POST['check'],
        'id' => $_SESSION['id'],
    ];

    $sql = "UPDATE tb_address SET status =:status WHERE id_address != :id_address  AND user=:id";
    $query = $conn->prepare($sql);
    $query->execute($data9);

    Header("Location:Cart.php");
}
