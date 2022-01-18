<?php require_once('include/linkcss.php') ?>
<?php require_once('connection/conn.php') ?>
<?php
$date = [

    'date_start' => substr($_POST['date'], 0, 10),
    'date_end' => substr($_POST['date'], -10),

];
// สินค้าขายดี 5 อันดับแรก
$sql = "SELECT * ,
SUM(od.Qty) as sumtotal
FROM tb_product   as p 
        INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
        INNER JOIN tb_color as c ON p.tb_color_id = c.id_color
        INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
        INNER JOIN tb_orders_detail as od ON p.id_product = od.ProductID
        INNER JOIN tb_orders as o ON od.OrderID = o.OrderID
        WHERE  o.status >=3 AND date(o.OrderDate) between :date_start AND :date_end 
        GROUP BY p.id_product ORDER BY sumtotal DESC LIMIT 5
        
        ";
$query = $conn->prepare($sql);
$query->execute($date);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- ประเภทสินค้าขายดี 5 อันดับแรก -->
<?php
$sql2 = "SELECT * ,
SUM(od.Qty) as sumqty
FROM tb_product   as p 
        INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
        INNER JOIN tb_color as c ON p.tb_color_id = c.id_color
        INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
        INNER JOIN tb_orders_detail as od ON p.id_product = od.ProductID
        INNER JOIN tb_orders as o ON od.OrderID = o.OrderID
        WHERE o.status >=3 AND date(o.OrderDate) between :date_start AND :date_end 
        GROUP BY t.id_type_product ORDER BY sumqty DESC LIMIT 5
        
        ";
$query2 = $conn->prepare($sql2);
$query2->execute($date);
$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- ยอดขาย -->
<?php
$sqlprice = "SELECT * ,
SUM(p.price * od.Qty) as sumprice ,
SUM(p.cost) as cost ,
SUM((p.price - p.cost) * od.Qty ) as profit, 
SUM(od.Qty) as sumQty


FROM tb_product   as p 
        INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
        INNER JOIN tb_color as c ON p.tb_color_id = c.id_color
        INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
        INNER JOIN tb_orders_detail as od ON p.id_product = od.ProductID
        INNER JOIN tb_orders as o ON od.OrderID = o.OrderID
        WHERE o.status >=3 AND date(o.OrderDate) between :date_start AND :date_end 
        GROUP BY t.id_type_product 
        
        ";
$queryprice = $conn->prepare($sqlprice);
$queryprice->execute($date);
$resultprice = $queryprice->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- บล็อกข้อมูล    -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow  py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                ยอดขายทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                <?php
                                $total = 0;
                                $totalcost = 0;
                                $totalprofit = 0;
                                $totalsumQty = 0;
                                foreach ($resultprice as $row) { ?>
                                    <?php $row['sumprice']; ?>

                                    <?php @$sumprice = $total += $row['sumprice'] ?>
                                    <?php @$profit = $totalprofit += $row['profit'] ?>
                                    <?php @$cost = $totalcost += $row['cost'] ?>
                                    <?php @$sumQty = $totalsumQty += $row['sumQty'] ?>
                                <?php } ?>
                                <?php echo number_format(@$sumprice)   ?>
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
            <div class="card border-left-success shadow  py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                ต้นทุนทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                <?php echo number_format(@$cost); ?>
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
            <div class="card border-left-warning shadow  py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                กำไรทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format(@$profit); ?>

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
            <div class="card border-left-info shadow  py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                จำนวนที่ขายได้</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format(@$sumQty); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->

    </div>
    <div class="row">
        <div class="col-6">

            <div id="sunprice">

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-6 ">
            <div class="text-center mb-3 "> สินค้าขายดี 5 อันดับแรก</div>
            <div id="sumtotal"></div>
        </div>
        <div class="col-6">
            <div class="text-center mb-3"> ประเภทสินค้าขายดี 5 อันดับแรก</div>
            <div class="mx-auto" id="sumqty"></div>
        </div>
    </div>

    <!-- สินค้าขายดี 5 อันดับแรก -->
    <script>
        var options = {

            series: [{
                    name: 'จำนวน',
                    data: [<?php
                            foreach ($result as $row) { ?>
                            <?php echo  $row['sumtotal']; ?>,
                        <?php } ?>
                    ]
                },

            ],

            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    borderRadius: 10,
                },
            },
            colors: [<?php
                        for ($x = 0; $x <= $query->rowCount(); $x++) {
                            printf("'#%06X',\n", mt_rand(0, 0xFFFFFF));
                        }
                        ?>],

            dataLabels: {
                enabled: true,
                formatter: (val) => {
                    var num1 = `${
                        val.toFixed()
                    }`;
                    var number = new Intl.NumberFormat().format(num1);
                    return number;
                },

            },

            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [<?php
                                foreach ($result as $row) { ?> ' <?php echo $row['title']; ?>',
                    <?php } ?>
                ],
                labels: {
                    show: false,
                    trim: true,
                }

            },
            yaxis: {
                title: {
                    text: '$ (ยอดขายสินค้า 5 อันดับแรก)'

                },
                labels: {
                    show: true,
                    trim: true,
                    style: {
                        fontSize: "16px",
                        fontWeight: 400,
                        fontFamily: "Mitr",
                        color: "#000",
                    },
                    formatter: (val) => {
                        var num1 = `${
                        val.toFixed()
                    }`;
                        var number = new Intl.NumberFormat().format(num1);
                        return number;
                    },
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return +val + " ชิ้น "
                    }
                }
            }

        };

        var chart = new ApexCharts(document.querySelector("#sumtotal"), options);
        chart.render();
    </script>
    <!-- ประเภทสินค้าขายดี 5 อันดับแรก -->
    <script>
        var options = {
            series: [<?php foreach ($result2 as $row2) { ?>
                    <?php echo $row2['sumqty']; ?>,

                <?php } ?>
            ],
            chart: {
                width: 380,
                type: 'pie',
                toolbar: {
                    show: true,
                    offsetX: 250,
                    offsetY: 0,

                }
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    borderRadius: 10,
                },
            },
            colors: [<?php
                        for ($x = 0; $x <= $query->rowCount(); $x++) {
                            printf("'#%06X',\n", mt_rand(0, 0xFFFFFF));
                        }
                        ?>],

            labels: [<?php foreach ($result2 as $row2) { ?> ' <?php echo $row2['title_type']; ?>  ',

                <?php } ?>
            ],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#sumqty"), options);
        chart.render();
    </script>
    <!-- ยอดขาย -->
    <script>

    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>