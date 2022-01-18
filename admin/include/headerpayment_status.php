<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php

$sql = "SELECT * FROM tb_orders WHERE status = 3 ";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
$res1 = mysqli_num_rows($query);


$sql2 =
    "SELECT * FROM tb_orders WHERE status = 1 ";
$query2 = mysqli_query($connection, $sql2);
$res2 = mysqli_num_rows($query2);

$sql3 =
    "SELECT * FROM tb_orders WHERE status = 2 ";
$query3 = mysqli_query($connection, $sql3);
$res3 = mysqli_num_rows($query3);

$sql4 =
    "SELECT * FROM tb_orders WHERE status = 5 ";
$query4 = mysqli_query($connection, $sql4);
$res4 = mysqli_num_rows($query4)
?>







<div class="mx-3">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow  py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                ยกเลิก</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                           

                          
                                    <?php echo number_format($res3) ?>
                           

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                กำลังจัดส่ง</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                            
                                    <?php echo number_format($res4) ?>
                       

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning  shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning  text-uppercase mb-1">
                                รอตรวจสอบการชำระเงิน</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                 <?php echo number_format($res2) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                รอดำเดินการจัดส่ง
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php echo $res1 ?>
                                    </div>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->

    </div>
</div>