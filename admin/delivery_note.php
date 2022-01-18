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

                 <div class="app-card app-card-settings card p-4">
                     <div class="app-card-body">
                         <div class="row">
                             <div class="col-6">
                                 รหัสคำสั่งซื้อ : <?php echo $result['OrderID'] ?>
                                 <br>
                                 จาก
                                 <br>
                                 Sira-on Shop
                                 <br>
                                 61/169 คู้บอน 36
                                 <br>
                                 เขตคลองสามวา แขวงบางชัน
                                 <br>
                                 กรุงเทพมหานคร 10510
                                 <br>
                                 โทรศัพท์: 097-276-5750
                                 <br>
                                 Email:Siraon_shop@gmail.com
                             </div>
                             <div class="col-6">
                                 <?php foreach ($query as $row) { ?>
                                     <?php

                                        $sql2 = "SELECT * FROM tb_address_orders as ao
                                        INNER JOIN tb_address  as a ON ao.id_address = a.id_address
                                        INNER JOIN province  as p ON a.province = p.ProvinceID
                                        INNER JOIN tambon as d ON a.districts = d.TambonID
                                        INNER JOIN district as t ON a.amphures = t.DistrictID
                                        WHERE ao.OrderID='" . $row['OrderID'] .  "'";
                                        $result = mysqli_query($connection, $sql2);
                                        $row = mysqli_fetch_assoc($result);

                                        $sql3 = "SELECT * FROM tb_admin ";
                                        $query2 = mysqli_query($connection, $sql3);
                                        $result2 = mysqli_fetch_assoc($query2)
                                        ?>

                                     <br>
                                     ถึง
                                     <br>
                                     <?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?>
                                     <br>
                                     <?php echo $row['address_details'] ?>
                                     <br>
                                     เขต <?php echo $row['DistrictName'] ?> แขวง <?php echo $row['TambonName'] ?>
                                     <br>
                                     <?php echo $row['ProvinceThai'] ?> <?php echo $row['zipcode'] ?>
                                     <br>
                                     โทรศัพท์: <?php echo $row['phone'] ?>
                                     <br>
                                     Email:<?php echo $result2['email'] ?>


                                 <?php } ?>


                             </div>
                             <button class="btn "> <a href="delivery_note2.php?id=<?php echo $_GET['id'] ?>" class=""><i class="fas fa-print"></i></a></button>
                         </div>

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