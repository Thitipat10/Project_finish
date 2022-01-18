<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php

if(isset($_POST['Order'])){
  
    $data2 = [

        'user' => $_POST['user'],
        'ProductID' => $_POST['ProductID'],
        'status' => 1
    ];

    $sql = "SELECT * FROM tb_cart WHERE user=:user AND ProductID=:ProductID AND status=:status";
    $query = $conn->prepare($sql);
    $query->execute($data2);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!empty($_SESSION['id'])) {
        if ($query->rowCount() == 1) {

            $sql = "SELECT  * , sum(c.qty) as SUM FROM tb_cart as c 
            INNER JOIN tb_size as s ON c.tb_size_id2 = s.id_size
            INNER JOIN tb_color as o ON c.tb_color_id2 = o.id_color
            INNER JOIN tb_product as p ON c.productID = p.id_product
            WHERE c.status = 1 AND c.productID = '" . $_POST['ProductID'] .  " '
            GROUP BY c.productID  ";
            $rowcart = mysqli_query($connection, $sql);
            $resutl = mysqli_fetch_assoc($rowcart);

            echo $resutl['qty'];
            $total = $_POST['qty'] +  $resutl['qty'];


            if ($total > $resutl['number']) {

                Header("Location:index.php");
            } else {
                $data = [

                    'id' => $_POST['ProductID'],
                    'qty' => $_POST['qty'],

                ];

                $sql = "UPDATE tb_cart SET qty =qty+:qty WHERE ProductID = :id ";
                $query = $conn->prepare($sql);
                $query->execute($data);

      
             Header("Location:Cart.php");
           
                 
            }
        } else {
            $data = [
                'user' => $_POST['user'],
                'ProductID' => $_POST['ProductID'],
                'qty' => $_POST['qty'],
                'tb_size_id2' => $_POST['tb_size_id2'],
                'tb_color_id2' => $_POST['tb_color_id2'],
                'status' => 1,
            ];

            $sql = "INSERT INTO tb_cart (productID,qty,user,tb_size_id2,tb_color_id2,status) VALUES (:ProductID,:qty,:user,:tb_size_id2,:tb_color_id2,:status) ";
            $query = $conn->prepare($sql);
            $query->execute($data);
       
            Header("Location:Cart.php");

        }
    } else {
        Header("Location:login.php");
    }
}
if (isset($_POST['addcart'])) {

@$idpro = $_GET['id'];
@$url = $_POST['url'];

$data = [
             
    'user' => $_POST['user'],
    'ProductID' => $_POST['ProductID'],
    'status' => 1
];

$sql = "SELECT * FROM tb_cart WHERE user=:user AND ProductID=:ProductID AND status=:status";
$query = $conn->prepare($sql);
$query->execute($data);
$result = $query->fetch(PDO::FETCH_ASSOC);
if(!empty($_SESSION['id'])){

if ($query->rowCount() == 1) {
    
    $sql = "SELECT  * , sum(c.qty) as SUM FROM tb_cart as c 
    INNER JOIN tb_size as s ON c.tb_size_id2 = s.id_size
    INNER JOIN tb_color as o ON c.tb_color_id2 = o.id_color
    INNER JOIN tb_product as p ON c.productID = p.id_product
    WHERE c.status = 1 AND c.productID = '" . $_POST['ProductID'] .  " '
    GROUP BY c.productID  ";
    $rowcart = mysqli_query($connection,$sql);
    $resutl = mysqli_fetch_assoc($rowcart);

   echo $resutl['qty'];
    $total = $_POST['qty'] +  $resutl['qty'];


    if ($total > $resutl['number']) {

        Header("Location:index.php");
    } else{
        $data = [

            'id' => $_POST['ProductID'],
            'qty' => $_POST['qty'],

        ];

        $sql = "UPDATE tb_cart SET qty =qty+:qty WHERE ProductID = :id ";
        $query = $conn->prepare($sql);
        $query->execute($data);

        $_SESSION['m'] = 1;
        if(empty($_GET['id'])){
         Header("Location:$url");
        }
         if (!empty($_GET['id'])) {
             Header("Location:$url?id=$idpro");
         }
           
    }
} else {
    $data = [
        'user' => $_POST['user'],
        'ProductID' => $_POST['ProductID'],
        'qty' => $_POST['qty'],
        'tb_size_id2' => $_POST['tb_size_id2'],
        'tb_color_id2' => $_POST['tb_color_id2'],
        'status' => 1,
    ];

    $sql = "INSERT INTO tb_cart (productID,qty,user,tb_size_id2,tb_color_id2,status) VALUES (:ProductID,:qty,:user,:tb_size_id2,:tb_color_id2,:status) ";
    $query = $conn->prepare($sql);
    $query->execute($data);
     $_SESSION['m'] = 1;
        if (empty($_GET['id'])) {
            Header("Location:$url");
        }
        if (!empty($_GET['id'])) {
            Header("Location:$url?id=$idpro");
        }
   
        
        
   
}
} else {
    Header("Location:login.php");

}
}