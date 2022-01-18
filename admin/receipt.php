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
     <title>Product</title>
     <?php require_once('include/linkcss.php') ?>
     <?php require_once('connection/conn.php') ?>
     <?php require_once('connection/connection.php') ?>
 </head>
 <style>
     * {
         margin: 0;
         padding: 0;
     }

     body {
         font-family: roboto;
         background: white;
     }

     .material-icons {
         cursor: pointer;
     }

     .invoice-container {
         margin: auto;
         padding: 0px 20px;
     }

     .invoice-header {
         display: flex;
         padding: 70px 0%;
         width: 100%;
     }

     .title {
         font-size: 18px;
         letter-spacing: 3px;
         color: rgb(66, 66, 66);
     }

     .date {
         padding: 5px 0px;
         font-size: 14px;
         letter-spacing: 3px;
         color: rgb(156, 156, 156);
     }

     .invoice-number {
         font-size: 17px;
         letter-spacing: 2px;
         color: rgb(156, 156, 156);
     }


     .space {
         width: 50%;
     }

     table {
         table-layout: auto;
         width: 100%;
     }

     table,
     th,
     td {
         border-collapse: collapse;
     }

     th {
         padding: 10px 0px;
         border-bottom: 1px solid #000;

         font-weight: 400;
         font-size: 13px;
         letter-spacing: 2px;
         color: #000;
         text-align: left;
     }


     td {
         padding: 10px 0px;
         border-bottom: 0.5px solid rgb(226, 226, 226);
         text-align: left;



     }

     .dashed {
         border-bottom: 1px solid rgb(187, 187, 187);
         border-bottom-style: dashed;
     }

     .total {
         font-weight: 800;
         font-size: 20px !important;
         color: black;
     }


     input[type=number] {
         text-align: center;
         max-width: 50px;
         font-size: 15px;
         padding: 10px;
         border: none;
         outline: none;
     }

     input[type=text] {
         max-width: 170px;
         text-align: left;
         font-size: 15px;
         padding: 10px;
         border: none;
         outline: none;
     }

     input[type=text]:focus {
         border-radius: 5px;
         background: #ffffff;
         box-shadow: 11px 11px 22px #d9d9d9,
             -11px -11px 22px #ffffff;
     }

     input[type=number]:focus {
         border-radius: 5px;
         background: #ffffff;
         box-shadow: 11px 11px 22px #d9d9d9,
             -11px -11px 22px #ffffff;
     }

     /*Hide Arrows From Input Number*/
     /* Chrome, Safari, Edge, Opera */
     input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
         -webkit-appearance: none;
         margin: 0;
     }

     /* Firefox */
     input[type=number] {
         -moz-appearance: textfield;
     }


     .float {

         width: 40px;
         height: 40px;
         background-color: #FF1D89;
         color: #FFF;
         border-radius: 100%;
         text-align: center;
         box-shadow:
             0 2.8px 2.2px rgba(0, 0, 0, 0.048),
             0 6.7px 5.3px rgba(0, 0, 0, 0.069),
             0 12.5px 10px rgba(0, 0, 0, 0.085),
             0 22.3px 17.9px rgba(0, 0, 0, 0.101),
             0 41.8px 33.4px rgba(0, 0, 0, 0.122),
             0 100px 80px rgba(0, 0, 0, 0.17);
     }

     .float:hover {
         background-color: #ff057e;
     }

     .plus {
         margin-top: 10px;
     }

     #sum {
         text-align: right;
         width: 100%;
     }

     #sum input[type=text] {
         width: 100%;
         font-size: 33px !important;
         color: black;
         text-align: right !important;

     }

     /* Medium devices (landscape tablets, 768px and up) */
     @media only screen and (min-width: 768px) {
         body {
             background: lemonchiffon;
             color: #000;
         }

         .invoice-container {
             border: solid 1px gray;
             width: 60%;
             margin: 50px auto;
             padding: 40px;
             padding-bottom: 100px;
             border-radius: 5px;
             background: white;
             box-shadow:
                 0 2.8px 2.2px rgba(0, 0, 0, 0.02),
                 0 6.7px 5.3px rgba(0, 0, 0, 0.028),
                 0 12.5px 10px rgba(0, 0, 0, 0.035),
                 0 22.3px 17.9px rgba(0, 0, 0, 0.042),
                 0 41.8px 33.4px rgba(0, 0, 0, 0.05),
                 0 100px 80px rgba(0, 0, 0, 0.07);
         }

         .title-date {
             width: 20%;
         }

         .invoice-number {
             width: 20%;
         }

         .space {
             width: 80%;
         }

         .text-r {
             text-align: right;
         }
     }
 </style>

 <body id="page-top">

     <?php require_once('include/header.php') ?>

     <?php require_once('include/headerpayment_status.php') ?>



     <script src="js/sb-admin-2.min.js"></script>

     <div class="container-fluid bg">
         <?php
            if (isset($_GET['id']) && !empty($_GET['id'])) {


                $id = $_GET['id'];

                $sql = "SELECT * FROM tb_orders  WHERE  OrderID = $id";
                $query = mysqli_query($connection, $sql);
                $result = mysqli_fetch_assoc($query);
            }

            ?>
         <h1 class="app-page-title ">รายการชำระเงิน </h1>


         <hr class="mb-4">

         <div class="row g-4 settings-section">

             <div class="col-12 col-md-12">

                 <div class="app-card app-card-settings ">

                     <div class="app-card-body">
                         <div class="invoice-container">

                             <div class="title-date">
                                 <h2 class="text-center">Sira-on Shop</h2>
                                 <?php echo $result['OrderDate'] ?>
                                 <br>
                                 เลขที่ใบสั่งซื้อ <?php echo $result['OrderID'] ?>
                             </div>
                             <div class="invoice-body">
                                 <table>
                                     <thead>
                                         <th>ลำดับ</th>
                                         <th style="padding-left:12px;">รายการ</th>
                                         <th>จำนวน</th>
                                         <th>ราคา</th>
                                         <th style="text-align: right;">รวม</th>
                                     </thead>
                                     <tbody>
                                         <?php foreach ($query as $row) { ?>
                                             <?php
                                                $i = 1;
                                                $total = 0;
                                                $totalsum = 0;
                                                $sqldetail =
                                                    "SELECT * FROM tb_orders_detail as d 
                                                    INNER JOIN tb_product as p    ON d.ProductID = p.id_product 
                                                    INNER JOIN tb_payment_orders as pm  ON d.OrderID = pm.id_order
                                                    INNER JOIN tb_payment as py  ON pm.id_bank = py.id_payment
                                                    WHERE d.OrderID = '" . $row['OrderID'] . "' ";
                                                $query2 = mysqli_query($connection, $sqldetail);
                                                $result2 = mysqli_fetch_assoc($query2);
                                                ?>
                                             <?php foreach ($query2 as $item) { ?>
                                                 <tr class="single-row">
                                                     <td><?php echo $i++; ?></td>
                                                     <td><?php echo $item['title'] ?></td>
                                                     <td><?php echo number_format($item['price']) ?></td>
                                                     <td> <?php echo $item['Qty'] ?></td>

                                                     <td style="text-align: right;"><span class="material-icons">&#3647;<?php echo number_format($item['Qty'] * $item['price']) ?></span></td>
                                                 </tr>
                                                 <?php $total += $item['price'] * $item['Qty'] ?>
                                             <?php } ?>
                                     </tbody>
                                 </table>
                                 <div style="text-align: right;">ยอดรวมชำระเงิน &#3647;<?php echo number_format($total) ?></div>
                             <?php } ?>
                             </div>
                             <button class="btn "> <a href="receipt2.php?id=<?php echo $_GET['id'] ?>" class=""><i class="fas fa-print"></i> พิมพ์</a></button>
                         </div>
                         <!--//app-card-body-->

                     </div>
                     <!--//app-card-->
                 </div>

             </div>
             <!--//row-->


             <script>
                 $(document).ready(function() {
                     $('#table_id').DataTable();
                 });
             </script>

             <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

         </div>

         <?php require_once('include/footer.php') ?>


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

 </body>


 </html>