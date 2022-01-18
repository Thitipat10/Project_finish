               <?php session_start() ?>
               <!DOCTYPE html>
               <html lang="en">
               <style>
                   body {
                       font-family: Arial, Helvetica, sans-serif;
                   }

                   /* The Modal (background) */
                   .modal {
                       display: none;
                       /* Hidden by default */
                       position: fixed;
                       /* Stay in place */
                       z-index: 1;
                       /* Sit on top */
                       padding-top: 100px;
                       /* Location of the box */
                       left: 0;
                       top: 0;
                       width: 100%;
                       /* Full width */
                       height: 100%;
                       /* Full height */
                       overflow: auto;
                       /* Enable scroll if needed */
                       background-color: rgb(0, 0, 0);
                       /* Fallback color */
                       background-color: rgba(0, 0, 0, 0.4);
                       /* Black w/ opacity */
                   }

                   /* Modal Content */
                   .modal-content {
                       background-color: #fefefe;
                       margin: auto;
                       padding: 20px;
                       border: 1px solid #888;
                       width: 80%;
                   }

                   /* The Close Button */
                   .close {
                       color: #aaaaaa;
                       float: end;
                       font-size: 28px;
                       font-weight: bold;
                   }

                   .close:hover,
                   .close:focus {
                       color: #000;
                       text-decoration: none;
                       cursor: pointer;
                   }
               </style>

               <style>
                   .container p {
                       text-align: center;
                       margin: 20px 0 30px 0;
                   }

                   #images {


                       display: flex;
                       flex-wrap: wrap;
                       gap: 20px;


                   }

                   .btt {
                       display: block;
                       position: relative;
                       background-color: #025bee;
                       color: #ffffff;
                       font-size: 16px;
                       text-align: center;
                       width: 300px;
                       padding: 18px 0;
                       margin: auto;
                       border-radius: 5px;
                       cursor: pointer;
                       flex-wrap: wrap;
                   }

                   .container p {
                       text-align: center;
                       margin: 20px 0 30px 0;
                   }

                   figure {
                       width: 45%;
                   }

                   img {
                       width: 100%;
                   }

                   figcaption {
                       text-align: center;
                       font-size: 2.4vmin;
                       margin-top: 0.5vmin;
                   }

                   input[type="file"] {
                       display: none;
                   }
               </style>

               <head>

                   <meta charset="utf-8">
                   <meta http-equiv="X-UA-Compatible" content="IE=edge">
                   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                   <meta name="description" content="">
                   <meta name="author" content="">
                   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
                   <script type="text/javascript" src="show.js"></script>

                   <title>SB Admin</title>
                   <?php require_once('include/linkcss.php') ?>
                   <?php require_once('connection/connection.php') ?>
                   <?php require_once('connection/conn.php') ?>

                   <?php
                    $sqlproduct =  "SELECT * FROM tb_product   as p 
                    INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
                    INNER JOIN tb_color as o ON p.tb_color_id = o.id_color
                    INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product ";
                    $queryproduct = mysqli_query($connection, $sqlproduct);
                    $result = mysqli_fetch_assoc($queryproduct);

                    ?>

                   <?php
                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        $id = $_GET['id'];


                        $sqlproduct =  "SELECT * FROM tb_product   as p 
                INNER JOIN tb_size as s ON p.tb_size_id = s.id_size
                INNER JOIN tb_color as o ON p.tb_color_id = o.id_color
                INNER JOIN tb_type_product as t ON p.type_product_id = t.id_type_product
                WHERE id_product ='" .   $id . " '";
                        $queryproduct = mysqli_query($connection, $sqlproduct);
                        $resultproduct = mysqli_fetch_assoc($queryproduct);
                    }

                    ?>
                   <?php

                    ?>
               </head>

               <body id="page-top">

                   <?php require_once('include/header.php') ?>
                   <?php


                    $query4 = "SELECT * FROM tb_type_product";
                    $result4 = mysqli_query($connection, $query4);
                    $query2 = "SELECT * FROM tb_color";
                    $result2 = mysqli_query($connection, $query2);
                    $query3 = "SELECT * FROM tb_size";
                    $result3 = mysqli_query($connection, $query3);


                    ?>


                   <div class="container-fluid ">

                       <div class="app-card-body">
                           <?php
                            if (isset($_POST) && !empty($_POST)) {
                                // echo '<pre>';
                                // print_r($_POST);
                                // echo '</pre>';

                                $title = $_POST['title'];
                                $detail = $_POST['detail'];
                                $number = $_POST['number'];
                                $sql = "UPDATE tb_product SET title='$title',detail='$detail',number='$number' WHERE id_product= '$id' ";
                                $query = mysqli_query($connection, $sql);




                                if (empty($_FILES['filUpload']['tmp_name'][0])) {
                                } else {

                                    $_SESSION['idid'] = $_POST['idimage'];
                                    $idid = $_SESSION['idid'];
                                    if (isset($_FILES["filUpload"])) {
                                        foreach ($_FILES['filUpload']['tmp_name'] as $key => $val) {

                                            $file_type = strrchr($_FILES['filUpload']['name'][$key], ".");
                                            $file_name = 'product_' . rand() . $file_type;
                                            $file_size = $_FILES['filUpload']['size'][$key];
                                            $file_tmp = $_FILES['filUpload']['tmp_name'][$key];
                                            $file_type = $_FILES['filUpload']['type'][$key];
                                            move_uploaded_file($file_tmp, 'upload/product/' . $file_name);
                                            $sql2 = "INSERT INTO tb_product_image (tb_product_id,image) VALUES ('$idid','$file_name')";
                                            $query2 = mysqli_query($connection, $sql2);
                                        }

                                        unset($_SESSION['idid']);
                                    }
                                }
                            }
                            ?>

                           <div class="row shadow-sm">
                               <div class="col-6">
                                   <div class=" p-4 my-4">


                                       <h1 class="app-page-title ">แก้ไขข้อมูลสินค้า</h1>
                                       <?php foreach ($queryproduct as $item) { ?>
                                           <?php
                                            $sql = "SELECT  * FROM tb_product_image as tt
                                            INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                                            WHERE  tt.tb_product_id = '" . $item['id_product'] . "'";
                                            $query = mysqli_query($connection, $sql);
                                            $result = mysqli_fetch_assoc($query);
                                            ?>
                                       <?php } ?>




                                       <form action="product_update_db.php" method="POST" enctype="multipart/form-data" id="form_con">

                                           <div class="mb-3">
                                               <label class="form-label">ชื่อสินค้า </label>
                                               <input type="text" class="form-control" name="title" value="<?= $resultproduct['title']; ?>" placeholder="ชื่อสินค้า">
                                           </div>
                                           <div class="mb-3">
                                               <label class="form-label">รายละเอียดสินค้า</label>
                                               <textarea name="detail" style="height:100px" class="form-control" placeholder="รายละเอียดสินค้า" id="description"><?= $result['detail']; ?> </textarea>
                                           </div>
                                           <hr class="mb-3 mt-4">
                                           <div class="mb-3">
                                               <label class="form-label">ราคา</label>
                                               <input type="text" class="form-control" name="price" value="<?= $resultproduct['price']; ?>" placeholder="ราคาสินค้า" disabled>
                                           </div>
                                           <div class="mb-3">
                                               <label class="form-label">ต้นทุน</label>
                                               <input type="text" class="form-control" name="cost" value="<?= $resultproduct['cost']; ?>" placeholder="ต้นทุนสินค้า" disabled>
                                           </div>
                                           <div class="mb-3">
                                               <label class="form-label">จำนวน</label>
                                               <input type="text" class="form-control" name="number" value="<?= $resultproduct['number']; ?>" placeholder="ราคาสินค้า">
                                           </div>



                                           <div class="mb-3 col-lg-7">
                                               <label class="form-label">ประเภทสินค้า</label>
                                               <select name="type_product_id" class="form-label" required disabled>
                                                   <option value="<?php echo $item['id_type_product']; ?>"><?php echo $item['title_type'] ?></option>
                                                   <?php foreach ($result4 as $row) { ?>
                                                       <option value=" <?php echo $row['id_type_product']; ?> ">
                                                           <?php echo $row['title_type']; ?></option>
                                                   <?php } ?>
                                               </select>
                                               <label class="form-label">สี</label>
                                               <select name="tb_color_id" class="form-label" required disabled>
                                                   <option value="<?php echo $item['id_color']; ?>"> <?php echo $item['title_color']; ?></option>
                                                   <?php foreach ($result2 as $row) { ?>
                                                       <option value=" <?php echo $row['id_color']; ?> ">
                                                           <?php echo $row['title_color']; ?></option>
                                                   <?php } ?>
                                               </select>
                                               <label class="form-label">ไซส์</label>
                                               <select name="tb_size_id" class="form-label" required disabled>
                                                   <option value="<?php echo $item['id_size']; ?>"> <?php echo $item['title_size']; ?></option>
                                                   <?php foreach ($result3 as $row) { ?>
                                                       <option value=" <?php echo $row['id_size']; ?> ">
                                                           <?php echo $row['title_size']; ?></option>
                                                   <?php } ?>
                                               </select>

                                           </div>
                                           <input type="hidden" name="idpro" value="<?php echo $resultproduct['id_product'] ?>">
                                           <button type="button" class="btn btn-primary" onclick="updateproduct()">บันทึก</button>
                                   </div>

                               </div>

                               <div class="col-6">

                                   <?php

                                    foreach ($queryproduct as $key => $item) { ?>

                                       <?php
                                        $sql2 = "SELECT  * FROM tb_product_image as tt
                                        INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                                        WHERE tt.tb_product_id = '" . $item['id_product'] . "'";
                                        $query2 = mysqli_query($connection, $sql2);
                                        $result = mysqli_fetch_assoc($query);

                                        ?>
                                       <div class="container">
                                           <a href="product.php"> <button type="button" class="btn btn-primary mb-4 flat-right">ย้อนกลับ</button></a>
                                           <p id="num-of-files">No Files Chosen</p>

                                           <div id="images"></div>

                                       </div>

                                       <label for="file-input" class="btn btn-danger">
                                           <i class="fas fa-upload"></i> &nbsp; เลือกรูปภาพ
                                       </label>

                                       <input class="mt-4" type="file" name="filUpload[]" id="file-input" accept="image/png, image/jpeg" onchange="preview()" multiple="multiple">
                                       <input type="hidden" name="idimage" value="<?php echo $item['id_product']; ?>">


                                       </form>
                                       <div class=" mt-4">
                                           <div class="m-3"> แก้ไขรูปภาพ</div>
                                           <div class="row">
                                               <?php foreach ($query2 as $row) { ?>

                                                   <div class="mx-3">

                                                       <div class="col-12">
                                                           <label><img src="upload/product/<?php echo $row['image'] ?>" width="150" height="150">
                                                               <label>
                                                                   <div class="mt-2">
                                                                       <form action="product_image_status.php?idproduct=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">

                                                                           <?php if ($row['statusimage'] == 1) { ?>
                                                                               <button class=" btn btn-sm btn-success float-end" disabled>ตั้งค่าเป็นรูปแรก</button>
                                                                           <?php } ?>
                                                                           <?php if ($row['statusimage'] == 0) { ?>
                                                                               <button class="btn btn-sm btn-success float-end ">ตั้งค่าเป็นรูปแรก</button>
                                                                           <?php } ?>
                                                                           <input type="hidden" name="status_image_product" value="1">
                                                                           <input type="hidden" name="id_product_image" value="<?php echo $row['id_product_image']; ?>">
                                                                           <input type="hidden" name="id_product" value="<?php echo $_GET['id']; ?>">

                                                                           <?php if ($row['statusimage'] == 0) { ?>
                                                                               <label for=""> <a href="del.php?del_product_image=<?php echo $row["id_product_image"]; ?>&idproduct=<?php echo $_GET['id']; ?>" class="btn btn-sm btn-danger del_product_image">ลบ</a></label>
                                                                           <?php } ?>

                                                                       </form>

                                                                   </div>
                                                               </label>
                                                           </label>
                                                       </div>

                                                       <br>
                                                   </div>


                                               <?php } ?>
                                           </div>
                                       </div>

                                   <?php } ?>
                               </div>

                           </div>

                       </div>

                       <script>
                           function updateproduct() {
                               Swal.fire({
                                   title: 'ยืนยันการแก้ไข',

                                   icon: 'warning',
                                   showCancelButton: true,
                                   confirmButtonColor: '#3085d6',
                                   cancelButtonColor: '#d33',
                                   confirmButtonText: 'ตกลง',
                                   cancelButtonText: 'ยกเลิก',

                               }).then((result) => {
                                   if (result.isConfirmed) {
                                       Swal.fire({
                                           title: 'เปลี่ยนข้อมูลสำเร็จ!',
                                           icon: 'success',
                                           showCancelButton: false,
                                           showConfirmButton: false,
                                           confirmButtonColor: '#3085d6',
                                           timer: 1500
                                       }).then(() => {
                                           $('#form_con').submit();
                                       })

                                   }
                               })

                           }
                       </script>
                       <script src="ckeditor/ckeditor.js"></script>
                       <script>
                           CKEDITOR.replace('description', {
                               height: '250px',

                           });
                       </script>
                       <script>
                           $('.del_product_image').on('click', function(e) {
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

                       <!-- <script>
                           let fileInput = document.getElementById("file-input");
                           let imageContainer = document.getElementById("images");
                           let numOfFiles = document.getElementById("num-of-files");

                           function preview() {
                               imageContainer.innerHTML = "";
                               numOfFiles.textContent = `${fileInput.files.length} Files Selected`;

                               for (i of fileInput.files) {
                                   let reader = new FileReader();
                                   let figure = document.createElement("figure");
                                   let figCap = document.createElement("figcaption");

                                   // figCap.innerText = i.name; // ชื่อไฟล์รูป
                                   figure.appendChild(figCap);
                                   reader.onload = () => {
                                       let img = document.createElement("img");
                                       img.setAttribute("src", reader.result);
                                       figure.insertBefore(img, figCap);
                                   }
                                   imageContainer.appendChild(figure);
                                   reader.readAsDataURL(i);
                               }
                           }
                       </script> -->
                       <script>
                           $(":file").on("change", function() {
                               var output = document.getElementById('output');
                               var file = this.files[0];
                               var fileType = file["type"];
                               var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
                               if ($.inArray(fileType, validImageTypes) < 0) {

                                   $('#image').val('');

                                   Swal.fire({
                                       title: 'ประเภทไฟล์ไม่ถูกต้อง !',
                                       icon: 'error',
                                       showCancelButton: false,
                                       showConfirmButton: false,
                                       confirmButtonColor: '#3085d6',
                                       timer: 1500
                                   })
                                   $('#images').attr('src', '');


                               } else {
                                   let fileInput = document.getElementById("file-input");
                                   let imageContainer = document.getElementById("images");
                                   let numOfFiles = document.getElementById("num-of-files");


                                   imageContainer.innerHTML = "";
                                   numOfFiles.textContent = `${fileInput.files.length} Files Selected`;

                                   for (i of fileInput.files) {
                                       let reader = new FileReader();
                                       let figure = document.createElement("figure");
                                       let figCap = document.createElement("figcaption");

                                       // figCap.innerText = i.name; // ชื่อไฟล์รูป
                                       figure.appendChild(figCap);
                                       reader.onload = () => {
                                           let img = document.createElement("img");
                                           img.setAttribute("src", reader.result);
                                           figure.insertBefore(img, figCap);
                                       }
                                       imageContainer.appendChild(figure);
                                       reader.readAsDataURL(i);
                                   }

                               }
                           });
                       </script>
                   </div>
                   <!--//app-card-body-->





               </body>

               </html>


               </div>
               <!--//container-fluid-->
               </div>
               <!--//app-content-->


               </div>
               <!--//app-wrapper-->



               </div>

               <?php require_once('include/footer.php') ?>
               <?php require_once('include/script.php') ?>

               </body>

               </html>