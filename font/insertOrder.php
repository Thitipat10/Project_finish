<?php
require_once('connection/conn.php');
require_once('connection/connection.php');

//  echo $_POST['price'];
// echo $_POST['payment'];
// echo $_POST['date'];


$data = [
    'id' => $_SESSION['id'],
    'OrderDate_END' => date('Y-m-d H:i:s', strtotime("1day 12:00:00"))
];

$sql = "INSERT INTO tb_orders (id_user,OrderDate_END) VALUES(:id,:OrderDate_END)";
$query = $conn->prepare($sql);
$query->execute($data);

$data2 = [
    'OrderID' => $conn->lastInsertId(),


];

$sql_detail = "INSERT INTO tb_orders_detail (OrderID,ProductID,Qty)
SELECT :OrderID, p.id_product , sum(c.qty) as QTY FROM tb_cart as c
INNER JOIN tb_product as p ON c.productID = p.id_product
WHERE c.status = 1 AND c.user = '" . $_SESSION['id'] . " '
GROUP BY c.productID";
$query_detail = $conn->prepare($sql_detail);
$query_detail->execute($data2);

$update = "UPDATE tb_cart SET status =2 WHERE status=1 AND user ='" . $_SESSION['id'] . "'";
$queryUp = $conn->prepare($update);
$queryUp->execute();


$dataid = [
        'id' => $_SESSION['id'],
     
    ];


$sqltb_orders = "SELECT * FROM tb_orders WHERE id_user=:id ORDER BY OrderID DESC LIMIT 1 ";
$query = $conn->prepare($sqltb_orders);
$query->execute($dataid);
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// print_r($result);
//  echo $result['OrderID']; 

$data3 = [
    'OrderID' => $result[0]['OrderID'],
    'price' => $_POST['price'],
    'price_no' => $_POST['price_no'],
   

];



$sql = "INSERT INTO tb_payment_orders (id_order,price_pm,price_no) VALUES(:OrderID,:price,:price_no)";
$query = $conn->prepare($sql);
$query->execute($data3);



// $data3 = [
//     'OrderID' => $result[0]['OrderID'],
//     'id_bank' => $_POST['payment'],
//     'date' => $_POST['date'],
//     'price' => $_POST['price'],
//     'time' => $_POST['time'],
//     'price_no' => $_POST['price_no'],
//     'filename' => $filename,

// ];



// $sql = "INSERT INTO tb_payment_orders (id_order,id_bank,date,time,price_pm,price_no,image_pm) VALUES(:OrderID,:id_bank,:date,:time,:price,:price_no,:filename)";
// $query = $conn->prepare($sql);
// $query->execute($data3);




$data4 =[
    'OrderID' => $result[0]['OrderID'],
    'address' => $_POST['address'],
];
$sqladdress = "INSERT INTO tb_address_orders (OrderID,id_address) VALUES(:OrderID,:address)";
$queryaddress = $conn->prepare($sqladdress);
$queryaddress->execute($data4);


$data5 = [
    'OrderID' => $result[0]['OrderID'],
 
];
$sqltb_orders = "SELECT * FROM tb_orders_detail WHERE OrderID=:OrderID ";
$querytb_orders  = $conn->prepare($sqltb_orders);
$querytb_orders->execute($data5);   



foreach ($querytb_orders as $row){
    $data6 = [
      
        'ProductID' => $row['ProductID'],
        'Qty'=> $row['Qty']
    
    ];

    $sqlpro = "UPDATE tb_product SET number=number-:Qty  WHERE id_product = :ProductID;";
    $query = $conn->prepare($sqlpro);
    $query->execute($data6);
}


Header("Location:payment.php?OrderID_id=". $result[0]['OrderID'])




?>

                      


