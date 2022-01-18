<?php require_once('connection/conn.php'); ?>
<?php

$data = [
    'OrderID' => $_POST['OrderID'],
    'status' => $_POST['check'],
];

$sql = "UPDATE tb_orders SET  status = :status WHERE OrderID =:OrderID ";
$query = $conn->prepare($sql);
$query->execute($data);

if ($_POST['check'] == 2) {

    $data0 = [
        'id' => $_SESSION['id'],
    ];
    $sqltb_orders = "SELECT * FROM tb_orders WHERE id_user=:id ORDER BY OrderID DESC LIMIT 1 ";
    $query = $conn->prepare($sqltb_orders);
    $query->execute($data0);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $data1 = [
        'OrderID' => $result[0]['OrderID'],

    ];
    $sqltb_orders = "SELECT * FROM tb_orders_detail WHERE OrderID=:OrderID ";
    $querytb_orders  = $conn->prepare($sqltb_orders);
    $querytb_orders->execute($data1);



    foreach ($querytb_orders as $row) {
        $data2 = [

            'ProductID' => $row['ProductID'],
            'Qty' => $row['Qty']

        ];

        $sqlpro = "UPDATE tb_product SET number=number+:Qty  WHERE id_product = :ProductID;";
        $query = $conn->prepare($sqlpro);
        $query->execute($data2);
    }
   
}


Header("Location:payment_list.php");




?>