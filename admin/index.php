<!DOCTYPE html>
<html lang="en">
<?php require_once('include/script.php') ?>
<style>
    .textinfo {
        position: absolute;
        bottom: 0;
        left: 0;
        text-align: center;
        width: 100%;
        padding: 5px;
        background-color: rgba(204, 204, 204, 0.8);
    }
</style>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin</title>
    <?php require_once('include/linkcss.php') ?>
    <?php require_once('connection/conn.php'); ?>
    <?php require_once('connection/connection.php'); ?>
</head>

<?php
$sqlDateEND = "SELECT * FROM tb_orders  WHERE status <=1  ORDER BY OrderID DESC ";
$queryDateEND = mysqli_query($connection, $sqlDateEND);
$res2 = mysqli_num_rows($queryDateEND);

$sqlDelivery_END = "SELECT * FROM tb_orders  WHERE status = 5  ORDER BY OrderID DESC ";
$queryDelivery_END = mysqli_query($connection, $sqlDelivery_END);
$res3 = mysqli_fetch_assoc($queryDelivery_END);



// echo $item['OrderID'];
date_default_timezone_set('Asia/Bangkok');
// $nextday =  time () + (1* 24 * 60 * 60);
//  $orderdate = date('Y-m-d' ,$nextday) ; 
foreach ($queryDateEND as $key => $item) { ?>

    <?php
    if ($item['status'] == 0) {
      
        if (date('Y-m-d H:i:s') > $item['OrderDate_END']) {
            $data = [

                'OrderID_id' => $item['OrderID'],
                'status' => 2
            ];
            $sql = "UPDATE tb_orders SET status=:status  WHERE OrderID=:OrderID_id";
            $query = $conn->prepare($sql);
            $query->execute($data);


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
        
    }

    ?>
<?php } ?>





<body id="page-top">
    <?php
    if (@$_SESSION['login'] == 1) {
        echo "<script>
        Swal.fire({
            position: '',
            icon: 'success',
            title: 'เข้าสู่ระบบสำเร็จ',
            showConfirmButton: false,
            timer: 1500
          })
        </script>   ";

        unset($_SESSION['login']);
    }
    ?>

    <?php require_once('include/header.php') ?>
    <script src="js/sb-admin-2.min.js"></script>


    <div class="container-fluid">


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
         
            <?php
            foreach ($queryDelivery_END as $key2 => $item2) { ?>

                <?php
                if ($item2['status'] == 5) {
                    if (date('Y-m-d H:i:s') > $item2['Delivery_END']) {
                        $data2 = [

                            'OrderID_id' => $item2['OrderID'],
                            'status' => 6
                        ];
                        $sql2 = "UPDATE tb_orders SET status=:status  WHERE OrderID=:OrderID_id";
                        $query2 = $conn->prepare($sql2);
                        $query2->execute($data2);
                    }
               
                }
                ?>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-2">

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"> <i class="fas fa-table"></i></div>
                    </div>
                    <input type="text" name="daterange" value="" id="daterange" class="inputdate" />
                    
                </div>
                <br>
            </div>
            <div class="col-10">
                <a href="report.php" class="btn btn-sm btn-danger"> ออกรายงาน</a>
            </div>
        </div>
        <div>

        </div>

        <!-- Content Row -->


        <!-- Content Row -->

        <div id="resultsumtotal"></div>



        <!-- Content Row -->


    </div>

    <?php require_once('include/footer.php') ?>

    <?php
    echo '<script> src="https://code.jquery.com/jquery-3.6.0.min.js"</script>
        <script> src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"</script>';


    ?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



    <!-- ส่งเวลา -->
    <script>
        $(document).ready(function() {
            $('#daterange').change(function() {
                var date = $('#daterange').val();
                $.ajax({
                    url: 'chart.php',
                    method: 'POST',
                    data: {
                        date: date
                    },
                    success(data) {
                        $('#resultsumtotal').html(data);
                    }

                });
                $.ajax({
                    url: 'report.php',
                    method: 'POST',
                    data: {
                        date: date
                    },
                    success(data) {
                        console.log(date)
                    }

                });
            });

        });
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                "locale": {
                    "format": "YYYY/MM/DD",
                    "separator": " ถึง ",
                    "applyLabel": "ยืนยัน",
                    "cancelLabel": "ยกเลือก",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "เลือกวันที่",
                    "daysOfWeek": [
                        "อา",
                        "จ",
                        "อ",
                        "พ",
                        "พฤ",
                        "ศ",
                        "ส"
                    ],
                    "monthNames": [
                        "มกราคม ",
                        "กุมภาพันธ์ ",
                        "มีนาคม ",
                        "เมษายน ",
                        "พฤษภาคม ",
                        "มิถุนายน ",
                        "กรกฎาคม ",
                        "สิงหาคม ",
                        "กันยายน ",
                        "ตุลาคม ",
                        "พฤศจิกายน ",
                        "ธันวาคม "
                    ],
                    "firstDay": 1
                },
                "singleDatePicker": false,
                ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 วันล่าสุด': [moment().subtract(6, 'days'), moment()],
                    '30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'ปีนี้': [moment().startOf('year'), moment().endOf('days')],
                },

            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>