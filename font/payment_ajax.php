<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php

// echo $_POST['id'];
// exit();



$id = $_POST['id'];
$sql = "SELECT * FROM tb_payment WHERE id_payment = '$id' ";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);

foreach ($query as $row) { ?>

    <div class="row">
        <div class="col-4">
            รูปแบบชำระเงิน
            <br>
            <?php echo $row['name_bank'] ?>
        </div>
        <div class="col-3">
            เลขที่บัญชี
            <br>
        
            <?php echo $row['number_bank'] ?>
        </div>
        <div class="col-5">
            ชื่อ
            <br>
           
            <?php echo $row['name_payment'] ?>
        </div>
    </div>
    <label> <br> <br> </label>
<?php } ?>