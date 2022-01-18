    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
    
    <?php


    if (isset($_POST) && !empty($_POST)) {
        // print_r($_POST);

        $parcel_number = $_POST['parcel_number'];
        $status = 5;
        $OrderID = $_POST['OrderID'];
        $Delivery_END = date('Y-m-d H:i:s', strtotime("14day 12:00:00"));

        $sqlnumber =  "UPDATE tb_orders  SET status='$status' ,parcel_number='$parcel_number' ,Delivery_END='$Delivery_END' WHERE OrderID = $OrderID";
        $querynumber = mysqli_query($connection, $sqlnumber);

        Header("Location:delivery_list.php");
    }

    ?>