<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../font/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sira-on Shop</title>
    <title>ชำระเงิน</title>
</head>
<?php
if (isset($_POST['OrderID_id'])) {
    $idor = $_POST['OrderID_id'];
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM tb_orders  WHERE id_user = $id AND status = 0 AND OrderID=$idor ORDER BY OrderID DESC ";
    $query = mysqli_query($connection, $sql);
}

if (isset($_GET['OrderID_id'])) {
    $idor = $_GET['OrderID_id'];
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM tb_orders  WHERE id_user = $id AND status = 0 AND OrderID=$idor ORDER BY OrderID DESC ";
    $query = mysqli_query($connection, $sql);
}

?>
<?php

$sqlpayment = "SELECT * FROM tb_payment WHERE status = 0";
$resutlpayment = mysqli_query($connection, $sqlpayment);
$resutl1 = mysqli_fetch_assoc($resutlpayment);
?>

<body class="bg-card">
    <div class="container">

        <?php foreach ($query as $key => $item) { ?>
            <?php
            $orid =$item['OrderID'];
            $sqldetail =
                "SELECT * FROM tb_orders_detail as d 
                        INNER JOIN tb_product as p ON d.ProductID = p.id_product 
                        INNER JOIN tb_orders as o ON d.OrderID = o.OrderID
                        INNER JOIN tb_payment_orders as paym ON o.OrderID = paym.id_order
                        WHERE d.OrderID = $orid  ";
            $query2 = mysqli_query($connection, $sqldetail);
            $result2 = mysqli_fetch_assoc($query2);

            ?>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="row  my-5 card">

                        <div class="col-6">
                            <div> ยอดขายสินค้าทั้งหมด <label class="text-orage"> &#3647;<?php echo number_format($result2['price_pm'], 2) ?></label></div>

                        </div>
                        <div class="col-6 ">
                            <div class="">

                            </div>

                        </div>

                    </div>
                    <?php foreach ($resutlpayment as $row) { ?>
                           
                                
                                
                        <div class="card my-5 p-3">
                            <div class="row ">
                                <div class="col-2"><img src="../admin/upload/payment/<?php echo $row['image'] ?>" alt="" width="100" height="100"></div>
                                <div class="col-10 float-start">
                                    <?php echo $row['name_bank']; ?>
                                    <div class="row mt-2">
                                        <div class="col-2">
                                            ชื่อบัญชี :
                                        </div>
                                        <div class="col-4 ">
                                            <div class="float-start"> <?php echo $row['name_payment']; ?></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 mt-2">
                                            เลขที่บัญชี :
                                        </div>
                                        <div class="col-4">
                                            <h3 class="text-orage float-start"><?php echo $row['number_bank']; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark m-3" data-bs-toggle="modal" data-bs-target="#ID">
                    แจ้งชําระเงิน
                    </button>
                    <a href="user_order.php " class="btn btn-dark m-3"> ชำระเงินภายหลัง</a>
                </div>
                <div class="col-2"></div>
            </div>


    </div>
    <!-- Modal -->
    <form action="payment_order.php" method="POST" id="form_con" enctype="multipart/form-data">
        <div class="modal fade" id="ID" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ชำระเงิน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="payment2"></div>
                        <Select class="form-select" name="payment" id="payment" required>
                            <option value="" selected disabled>กรุณาเลือกรูปแบบการชำระเงิน</option>
                            <?php foreach ($resutlpayment as $row) { ?>
                                <option value="<?php echo $row['id_payment']; ?>">
                                    <?php echo $row['name_bank']; ?> </option>
                            <?php } ?>
                        </Select>

                        <span class="text-danger" id="alert_payment"></span>
                        <div>
                            <hr class="my-3">
                            <img id="output" width="350" height="400" class="container " />
                            <div class="form-control my-4">
                                แนบสลิป :
                                <input type="file" accept="image/*" onchange="loadFile(event)" name="image" id="image">
                            </div>
                            <span class="text-danger" id="alert_image"></span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="time" name="time" class="form-control" id="time">
                                <span class="text-danger" id="alert_time"></span>
                            </div>
                            <div class="col-6">
                                <input type="date" name="date" class="form-control" id="date">
                                <span class="text-danger" id="alert_date"></span>
                            </div>
                        </div>

                        <br>

                        <div class="mt-2 text-center">ราคาทั้งหมด
                            <h3 class="text-danger">

                                &#3647;<?php echo number_format($result2['price_pm'], 2) ?>
                            </h3>

                        </div>
                        <label class="text-danger text-alert"> *กรุณาตรวจสอบจำนวนเงินให้ถูกต้อง กรณีจำนวนเงินไม่ถูกต้องจะไม่มีการรับผิดชอบ</label>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success sumbit" onclick="payment_s()">ชำระเงิน</button>
                    </div>
                </div>
            </div>

            <input type="hidden" name="OrderID" value="<?php echo $item['OrderID'] ?>">
            <input type="hidden" name="test" value="55">




    </form>
    </div>

<?php } ?>


<script type="text/javascript">
    $('#payment').change(function() {
        var id_payment = $(this).val();
        $.ajax({
            type: "post",
            url: "payment_ajax.php",
            data: {
                id: id_payment,

            },
            success: function(data) {
                $('#payment2').html(data);
            }
        });
    });
</script>
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
			$('#output').attr('src', '');


		} else {
			output.src = URL.createObjectURL(event.target.files[0]);
			output.onload = function() {
				URL.revokeObjectURL(output.src) // free memory
			}
		}
	});
</script>
<script>
    function payment_s() {

        var payment = $('#payment').val();
        var image = $('#image').val();
        var time = $('#time').val();
        var date = $('#date').val();


        if (payment == null) {
            $('#alert_payment').html('กรุณาเลือกช่องทางการชำระเงิน');

        }

        if (image == '') {
            $('#alert_image').html('กรุณาเลือกรูปหลักฐานการชำระเงิน');

        }
        if (time == '') {
            $('#alert_time').html('กรุณากรอกเวลา');

        }
        if (date == '') {
            $('#alert_date').html('กรุณาวันที่');

        }

        if (payment != null & image != '' & time != '' & date != '') {
            Swal.fire({
                title: 'ยืนยันชำระเงิน',

                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',

            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'ชำระเงินสำเร็จ!',
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

    }
</script>
</body>

</html>