<!DOCTYPE html>
<html lang="en">
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "Rubik", sans-serif;
    }

    body {
        background-color: #f5f8ff;
    }

    .container {
        background-color: #ffffff;
        width: 60%;
        min-width: 450px;
        position: relative;
        margin: 50px auto;
        padding: 50px 20px;
        border-radius: 7px;
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.05);
    }

    input[type="file"] {
        display: none;
    }



    .container p {
        text-align: center;
        margin: 20px 0 30px 0;
    }

    #images {
        width: 90%;
        position: relative;
        margin: auto;
        display: flex;
        justify-content: space-evenly;
        gap: 10px;
        flex-wrap: wrap;
    }


    img {
        width: 300px;
        height: 300px;
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
</head>

<body id="page-top">

    <?php require_once('include/header.php') ?>
    <?php


    $query = "SELECT * FROM tb_type_product WHERE  status = 0";
    $result = mysqli_query($connection, $query);
    $query2 = "SELECT * FROM tb_color";
    $result2 = mysqli_query($connection, $query2);
    $query3 = "SELECT * FROM tb_size";
    $result3 = mysqli_query($connection, $query3);


    ?>


    <div class="container-fluid container">

        <div class="app-card-body">
            <?php

            if (isset($_POST) && !empty($_POST)) {
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
                $type_product_id = $_POST['type_product_id'];
                $tb_color_id = $_POST['tb_color_id'];
                $tb_size_id = $_POST['tb_size_id'];
                $title = $_POST['title'];
                $detail = $_POST['detail'];
                $price = $_POST['price'];
                $number = $_POST['number'];
                $cost = $_POST['cost'];


                $sql = "INSERT INTO tb_product 
											(type_product_id, tb_color_id, tb_size_id, title, detail, price,number,cost)
										VALUES ('$type_product_id', '$tb_color_id', '$tb_size_id','$title','$detail','$price','$number','$cost')";

                if (mysqli_query($connection, $sql)) {
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }
                $PROID =  $connection->insert_id;
                if (isset($_FILES["filUpload"])) {
                    foreach ($_FILES['filUpload']['tmp_name'] as $key => $val) {

                        $file_type = strrchr($_FILES['filUpload']['name'][$key], ".");
                        $file_name = 'product_' . rand() . $file_type;
                        $file_size = $_FILES['filUpload']['size'][$key];
                        $file_tmp = $_FILES['filUpload']['tmp_name'][$key];
                        $file_type = $_FILES['filUpload']['type'][$key];
                        move_uploaded_file($file_tmp, 'upload/product/' . $file_name);
                        $sql2 = "INSERT INTO tb_product_image (tb_product_id,image) VALUES ('$PROID','$file_name')";
                        $query2 = mysqli_query($connection, $sql2);
                    }
                    echo "Copy/Upload Complete";
                }

                // $sqlproduct = "SELECT * FROM tb_product_image WHERE tb_product_id = '$PROID' ORDER BY tb_product_id ASC ";
                // $queryproduct = mysqli_query($connection,$sqlproduct);

                $status = 1;

                $sqlproduct = "UPDATE tb_product_image SET statusimage ='$status' WHERE tb_product_id = '$PROID' ORDER BY tb_product_id ASC LIMIT 1 ";
                $queryproduct = mysqli_query($connection, $sqlproduct);
            }


            ?>
            <div class="card p-4 my-4">
                <h1 class="app-page-title ">เพิ่มข้อมูลสินค้า<a href="product.php"> <button type="button" class="btn btn-primary mb-4 float-right">ย้อนกลับ</button></a></h1>
                <div class="container">

                    <p id="num-of-files">No Files Chosen</p>

                    <div id="images"></div>

                </div>


                <form action="" method="POST" enctype="multipart/form-data" id="form_con">
                    <div class="mb-3">
                        <label for="file-input" class="btn btn-danger" id="image">
                            <i class="fas fa-upload"></i> &nbsp; เลือกรูปภาพ
                        </label>
                        <input class="mt-4" type="file" name="filUpload[]" id="file-input" accept="image/png, image/jpeg" onchange="preview()" multiple="multiple" required>
                        <span id="alert_image" class="text-danger"></span>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">ชื่อสินค้า </label>

                        <input type="text" class="form-control" name="title" id="title" placeholder="ชื่อสินค้า" required>
                        <span id="alert_title" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">รายละเอียดสินค้า</label>
                        <textarea name="detail" style="height:100px" class="form-control" placeholder="รายละเอียดสินค้า" id="description">
                        </textarea>
                        <span id="alert_description" class="text-danger"></span>
                    </div>
                    <hr class="mb-3 mt-4">
                    <div class="mb-3">
                        <label class="form-label">ราคา</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="ราคาสินค้า" required>
                        <span id="alert_price" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ต้นทุน</label>
                        <input type="text" class="form-control" name="cost" id="cost" placeholder="ต้นทุนสินค้า   " required>
                        <span id="alert_cost" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">จำนวน</label>
                        <input type="text" class="form-control" name="number" id="number" placeholder="ราคาสินค้า" required>
                        <span id="alert_number" class="text-danger"></span>
                    </div>

                    <div class="mb-3 col-lg-12">
                        <label class="form-label">ประเภทสินค้า</label>
                        <select name="type_product_id" class="form-label" id="type_product_id" required>
                            <option value="" selected disabled>ประเภทสินค้า</option>
                            <?php foreach ($result as $row) { ?>
                                <option value="  <?php echo $row['id_type_product']; ?> ">
                                    <?php echo $row['title_type']; ?></option>
                            <?php } ?>
                        </select>
                        <span id="alert_type_product_id" class="text-danger"></span>
                        <label class="form-label">สี</label>
                        <select name="tb_color_id" class="form-label" id="tb_color_id" required>
                            <option value="" selected disabled>สี</option>
                            <?php foreach ($result2 as $row) { ?>
                                <option value=" <?php echo $row['id_color']; ?> ">
                                    <?php echo $row['title_color']; ?></option>
                            <?php } ?>
                        </select>

                        <span id="alert_tb_color_id" class="text-danger"></span>
                        <label class="form-label">ไซส์</label>
                        <select name="tb_size_id" class="form-label" id="tb_size_id" required>
                            <option value="" selected disabled>ไซส์</option>
                            <?php foreach ($result3 as $row) { ?>
                                <option value=" <?php echo $row['id_size']; ?> ">
                                    <?php echo $row['title_size']; ?></option>
                            <?php } ?>
                        </select>
                        <span id="alert_tb_size_id" class="text-danger"></span>
                    </div>


                    <button type="button" class="btn btn-primary" onclick="insertproduct()">บันทึก</button>
                </form>

            </div>

            <script src="ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('description', {
                    height: '250px',

                });
            </script>
        </div>
        <!--//app-card-body-->
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
                    $('#images').attr('src', 'https://i1.sndcdn.com/artworks-000335143458-q3i6f4-t500x500.jpg');


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
        <script>

        </script>



        <script>
            function insertproduct() {

                var image = $('#image').val();
                var title = $('#title').val();
                var description = $('#description').val();
                var price = $('#price').val();
                var cost = $('#cost').val();
                var number = $('#number').val();
                var type_product_id = $('#type_product_id').val();
                var tb_color_id = $('#tb_color_id').val();
                var tb_size_id = $('#tb_size_id').val();



                // if (image == '') {
                //     $('#alert_image').html('กรุณาใส่รูป');

                // } else {
                //     $('#alert_image').html('');
                // }

                if (title == '') {
                    $('#alert_title').html('กรุณากรอกชื่อสินค้า');

                } else {
                    $('#alert_title').html('');
                }
                // if (description == '') {
                //     $('#alert_description').html('กรุณากรอกชื่อผู้ใช้');
                // } else {
                //     $('#alert_description').html('');
                // }
                if (price == '') {
                    $('#alert_price').html('กรุณากรอกราคาสินค้า');

                } else {
                    $('#alert_price').html('');
                }
                if (cost == '') {
                    $('#alert_cost').html('กรุณากรอกราคาต้นทุนสินค้า');

                } else {
                    $('#alert_cost').html('');
                }
                if (number == '') {
                    $('#alert_number').html('กรุณากรอกจำนวนสินค้า');

                } else {
                    $('#alert_number').html('');
                }
                if (type_product_id == null) {
                    $('#alert_type_product_id').html('กรุณากรอกเลือกประเภท');

                } else {
                    $('#alert_type_product_id').html('');
                }
                if (tb_color_id == null) {
                    $('#alert_tb_color_id').html('กรุณาเลือกสี');

                } else {
                    $('#alert_tb_color_id').html('');
                }
                if (tb_size_id == null) {
                    $('#alert_tb_size_id').html('กรุณาเลือกไซส์');

                } else {
                    $('#alert_tb_size_id').html('');
                }


                if (title != '' & price != '' & cost != '' & number != '' & type_product_id != null & tb_color_id != null & tb_size_id != null) {
                    Swal.fire({
                        title: 'ยืนยันการเปลี่ยนข้อมูล',

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
                                timer: 2500
                            }).then(() => {
                                $('#form_con').submit();
                            })

                        }
                    })


                }
            }
        </script>

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