<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <title>Report</title>

    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
</head>





<script src="js/sb-admin-2.min.js"></script>

<div class="container-fluid bg">
    <?php
    $date = [

        'date_start' => substr($_POST['date'], 0, 10),
        'date_end' => substr($_POST['date'], -10),

    ];
    $sql2 = "SELECT * ,
        SUM(od.Qty * p.price) as sumqty,
        SUM((od.Qty * p.price) - p.cost) as profit
        FROM tb_product   as p 
        INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
        INNER JOIN tb_color as c ON p.tb_color_id = c.id_color
        INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
        INNER JOIN tb_orders_detail as od ON p.id_product = od.ProductID
        INNER JOIN tb_orders as o ON od.OrderID = o.OrderID 
         INNER JOIN tb_payment_orders as pyo ON pyo.id_order = o.OrderID
        WHERE o.status >=3 AND date(o.OrderDate) between :date_start AND :date_end 
        GROUP BY p.id_product ORDER BY sumqty DESC  
        
        ";
    $query2 = $conn->prepare($sql2);
    $query2->execute($date);
    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    ?>




    <div class="app-card-body mt-4 text-black">

        <div class="text-center text-black"> Sira-on Shop</div>
        <div class="text-center text-black"> รายงาน ยอดขายสินค้า</div>
        <div class="text-center mb-3 text-black"> จากวันที่ <?php echo date("d/m/Y", strtotime($date['date_start'])) ?> ถึง <?php echo date("d/m/Y", strtotime($date['date_end'])) ?></div>


        <table class="table text-font">
            <thead>
                <tr class="">
                    <th scope="col">ลำดับ</th>
                    <th scope="col" class="text-center">วันที่</th>
                    <th scope="col"class="text-center">รายการ</th>   
                    <th scope="col"class="text-center">จำนวน</th>
                    <th scope="col"class="text-center">ราคา</th>
                    <th scope="col"class="text-center">ยอดรวม</th>
                    <th scope="col"class="text-center">ต้นทุน</th>
                    <th scope="col" class="text-center">กำไร</th>
                 
                </tr>
            </thead>

            <?php
            $i = 1;
            $totalprice = 0;
            $totalsumqty = 0;
            $totalcost = 0;
            $totalprofit = 0;
            $totalQty = 0;
            foreach ($result2 as $row) { ?>
                <?php
                $sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id       
                             WHERE statusimage = 1  AND tt.tb_product_id = '" . $row['id_product'] . "'";
                $query = mysqli_query($connection, $sql);
                $result = mysqli_fetch_assoc($query);
                ?>
                <tbody>
                    <tr >
                        <td><?php echo $i++; ?></td>
                        <td class=""><?php echo date("d/m/Y", strtotime($row['OrderDate'])) ?> </td>
                        <td class=""><?php echo $row['title'] ?> </td>
                        <td class="text-center"> <?php echo $row['Qty'] ?></td>
                        <td class="text-right"> <?php echo number_format($row['price'],) ?></td>
                        <td class="text-right"> <?php echo number_format($row['sumqty'],) ?></td>
                        <td class="text-right"> <?php echo number_format($row['cost'],) ?></td>
                        <td class="text-right"> <?php echo number_format($row['profit'],) ?></td>
                    </tr>

                </tbody>
                <?php
                $profit = $totalprofit += $row['profit'];
                $cost = $totalcost += $row['cost'];
                $sumqty = $totalsumqty += $row['sumqty'];
                $price = $totalprice += $row['price'];
                $Qty = $totalQty += $row['Qty'];



                ?>

            <?php  } ?>
            <div>

                <td class="mt-3 text-bold"></td>
                <td class="mt-3 text-bold"></td>
                <td class="mt-3 text-bold"></td>
                <td class="mt-3 text-bold text-right"></td>
                <td class="mt-3 text-bold text-right"></td>
                <td class="mt-3 text-bold text-right"></td>
                
          
            </div>
         
               
       
            
        </table>
                
        <div class="text-right">
            
                 ต้นทุนทั้งหมด  <?php echo number_format(@$cost) ?> บาท
                    <br>
                    รายได้ทั้งหมด  <?php echo number_format(@$sumqty) ?> บาท
                    <br>
                    กำไรทั้งหมด   <?php echo number_format(@$profit) ?> บาท
         </div> 
    </div>
    <!--//app-card-body-->


    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>

    <script src=" vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>



    <script>
        $('.del_product').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'คุณต้องการลบ ID ผู้ใช้ ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;

                }
            })
        });
    </script>
    <?php
    if (@$_SESSION['m'] == 1) {
        echo "<script>
        Swal.fire({
            position: '',
            icon: 'success',
            title: 'ลบสำเร็จ',
            showConfirmButton: false,
            timer: 1500
          })
        </script>   ";

        unset($_SESSION['m']);
    }
    ?>




</html>