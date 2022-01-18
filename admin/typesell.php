<?php require_once('include/linkcss.php') ?>
<?php require_once('connection/conn.php') ?>
<?php
$date = [

    'date_start' => substr($_POST['date'], 0, 10),
    'date_end' => substr($_POST['date'], -10),

];


?>
<!-- ประเภทสินค้าขายดี 5 อันดับแรก -->
<?php
$sqlqty = "SELECT * ,
SUM(od.Qty) as sumqtytype
FROM tb_product   as p 
        INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
        INNER JOIN tb_color as c ON p.tb_color_id = c.id_color
        INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
        INNER JOIN tb_orders_detail as od ON p.id_product = od.ProductID
        INNER JOIN tb_orders as o ON od.OrderID = o.OrderID
        WHERE o.status >=3 AND date(o.OrderDate) between :date_start AND :date_end 
        GROUP BY t.id_type_product ORDER BY sumqtytype DESC LIMIT 5
        
        ";
$queryqty = $conn->prepare($sqlqty);
$queryqty->execute($date);
$resultqty = $queryqty->fetchAll(PDO::FETCH_ASSOC);

?>




<div class="app-card-body mt-4  text-black">

    <div class="text-center mb-3 mt-5 text-black text-bold"> ประเภทสินค้าขายดี 5 อันดับแรก</div>
    <div class="center0" id="sumqtytype"></div>
    <div class="center0" id="bar"></div>
</div>
<script>
  
</script>
<!-- ประเภทสินค้าขายดี 5 อันดับแรก -->
<script>
    var options = {
        series: [<?php foreach ($resultqty as $rowqty) { ?>
                <?php echo $rowqty['sumqtytype']; ?>,

            <?php } ?>
        ],
        chart: {
            width: 480,
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
                    for ($x = 0; $x <= $queryqty->rowCount(); $x++) {
                        printf("'#%06X',\n", mt_rand(0, 0xFFFFFF));
                    }
                    ?>],

        labels: [<?php foreach ($resultqty as $rowqty) { ?> ' <?php echo $rowqty['title_type']; ?>  ',

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
    var chart2 = new ApexCharts(document.querySelector("#sumqtytype"), options);
    chart2.render();
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>