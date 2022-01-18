<?php require_once('account.php'); ?>
<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>

<?php



$sql = "SELECT * FROM province";
$query = mysqli_query($connection, $sql);


$sql2 = "SELECT * FROM district";
$query2 = mysqli_query($connection, $sql2);


$sql3 = "SELECT * FROM tambon";
$query3 = mysqli_query($connection, $sql3);

// if (@!empty($_POST['firstname'])) {
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $phone = $_POST['phone'];
//     $province = $_POST['province'];
//     $amphures = $_POST['amphures'];
//     $districts = $_POST['districts'];
//     $zipcode = $_POST['zipcode'];
//     $address_details = $_POST['address_details'];
//     $user = $_SESSION['id'];
//     $status = 1;
//     if (!empty($user)) {
//         $sql_check = "SELECT * FROM tb_address WHERE user = '$user' AND address_details='$address_details'";
//         $query_check = mysqli_query($connection, $sql_check);
//         $row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
//         if ($row_check > 0) {
//         } else {

//             $sql1 = "INSERT INTO tb_address 
//         (firstname,lastname,phone,province,amphures,districts,zipcode,address_details,user,status)
//         VALUES ('$firstname', '$lastname','$phone','$province','$amphures','$districts','$zipcode','$address_details','$user','$status')";
//             if (mysqli_query($connection, $sql1)) {
//             } else {
//                 echo "Error: " . $sql1 . "<br>" . mysqli_error($connection);
//             }
//         }
//     }
// }




?>

<?php

$sql2 = "SELECT * FROM tb_address as a
INNER JOIN province  as p ON a.province = p.ProvinceID
INNER JOIN tambon as d ON a.districts = d.TambonID
INNER JOIN district as t ON a.amphures = t.DistrictID 
WHERE  a.user = '" . @$_SESSION['id'] .  "'";

$result = mysqli_query($connection, $sql2);
$reee = mysqli_fetch_assoc($result);

?>
<div class="col-10">
    <div class="row">

        <div class="col-12 col-lg-12 my-2">
            <div class="card o-hidden border-0 shadow-sm ">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->

                    <div class="p-5">
                        <div class="text-center">
                        </div>
                        <label>
                            <h5 class="app-page-title mb-2">ที่อยู่ของฉัน</h5>

                        </label>
                        <button type="button " class="btn btn-orange float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            + เพิ่มที่อยู่
                        </button>

                        <!-- Modal + -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> ที่อยู่จัดส่ง</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="address_db.php" method="POST" id="form_con">
                                        <div class="modal-body">
                                            <hr>

                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control me-3" placeholder="ชื่อ" name="firstname" id="firstname">
                                                <input type="text" class="form-control" placeholder="นามสกุล" name="lastname" id="lastname">

                                            </div>
                                            <span id="alert_firstname" class="text-danger"></span>
                                            <span id="alert_lastname" class="text-danger"></span>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="หมายเลขโทรศัพท์" name="phone" id="phone">
                                            </div>
                                            <span id="alert_phone" class="text-danger"></span>
                                            <div class="input-group mb-3">
                                                <Select class="form-select" name="province" id="province">
                                                    <option value="" selected disabled>กรุณาเลือกจังหวัด</option>
                                                    <?php foreach ($query as $value) { ?>
                                                        <option value="<?php echo $value['ProvinceID']; ?>">
                                                            <?php echo $value['ProvinceThai']; ?> </option>
                                                    <?php } ?>
                                                </Select>
                                                <Select class="form-select" name="amphures" id="amphures">
                                                    <option selected disabled>กรุณาเลือกอำเภอ</option>
                                                </Select>
                                            </div>
                                            <span id="alert_province" class="text-danger"></span>
                                            <span id="alert_amphures" class="text-danger"></span>
                                            <div class="input-group mb-3">
                                                <Select class="form-select" name="districts" id="districts">
                                                    <option selected disabled>กรุณาเลือกตำบล</option>
                                                </Select>
                                                <input class="form-control" type="text" name="zipcode" id="zipcode" placeholder="รหัสไปรษณีย์">
                                            </div>
                                            <span id="alert_districts" class="text-danger"></span>
                                            <div class="input-group mb-3">
                                                <textarea type="text" class="form-control textarea" id="address_details" name="address_details" id="" cols="30" rows="10" placeholder="รายละเอียดที่อยู่" style="height: 60px"></textarea>

                                            </div>
                                            <span id="alert_address_details" class="text-danger"></span>
                                            <br>
                                            <div class="form-check form-check-inline ">
                                                <input class="form-check-input" type="radio" name="status0" id="inlineRadio1" value="0">
                                                <label class="form-check-label" for="inlineRadio1"> ตั่งค่าเริ่มต้น</label>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="insertaddress()">ยืนยัน</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            function insertaddress() {

                                var firstname = $('#firstname').val();
                                var lastname = $('#lastname').val();
                                var phone = $('#phone').val();
                                var province = $('#province').val();
                                var amphures = $('#amphures').val();
                                var districts = $('#districts').val();
                                var address_details = $('#districts').val();


                                if (firstname == '') {
                                    $('#alert_firstname').html('กรุณากรอกชื่อ');
                                } else {
                                    $('#alert_firstname').html('');
                                }
                                if (lastname == '') {
                                    $('#alert_lastname').html('กรุณากรอกนามสกุล');
                                } else {
                                    $('#alert_lastname').html('');
                                }
                                if (phone == '') {
                                    $('#alert_phone').html('กรุณากรอกหมายเลขโทรศัพท์');
                                } else {
                                    $('#alert_phone').html('');
                                }
                                if (province == null) {
                                    $('#alert_province').html('กรุณาเลือกจังหวัด');
                                } else {
                                    $('#alert_province').html('');
                                }
                                if (amphures == null) {
                                    $('#alert_amphures').html('กรุณาเลือกอำเภอ');
                                } else {
                                    $('#alert_amphures').html('');
                                }
                                if (districts == null) {
                                    $('#alert_districts').html('กรุณาเลือกตำบล');
                                } else {
                                    $('#alert_districts').html('');
                                }
                                if (address_details == null) {
                                    $('#alert_address_details').html('กรุณากรอกรายละเอียด');
                                } else {
                                    $('#alert_address_details').html('');
                                }



                                if (firstname != '' & lastname != '' & phone != '' & province != null & amphures != null & districts != null & address_details != null) {
                                    Swal.fire({
                                        title: 'ยืนยันการเพิ่มที่อยู่',

                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'ตกลง',
                                        cancelButtonText: 'ยกเลิก',

                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire({
                                                title: 'เพิ่มที่อยู่สำเร็จ!',
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
                        <hr class="mb-3 mt-4">
                        <div class="row g-3 mt-4 ">
                            <?php foreach ($result as $row => $item) { ?>
                                <div class="col-8 px-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="float-end"> ชื่อ-นามสกุล </div>
                                            <br>
                                            <div class="float-end"> โทรศัพท์</div>
                                            <br>
                                            <div class="float-end"> ที่อยู่</div>

                                            <?php echo $item['id_address'] ?>
                                        </div>
                                        <div class="col-8">
                                            <div> <?php echo $item['firstname']; ?><?php echo $item['lastname']; ?> <?php if ($item['status'] == 0) { ?>

                                                    <label class="badge bg-success">ค่าเริ่มต้น</label>
                                                <?php } ?>
                                            </div>
                                            <div> <?php echo $item['phone']; ?></div>
                                            <div>
                                                <?php echo $item['address_details']; ?>
                                                <br>เขต<?php echo $item['DistrictName']; ?>
                                                <br>แขวง <?php echo $item['TambonName']; ?>
                                                <br>จังหวัด <?php echo $item['ProvinceThai']; ?>
                                                <br><?php echo $item['zipcode']; ?>
                                            </div>
                                        </div>
                                    </div>




                                    <br>
                                    <label> </label>
                                    <br>


                                </div>
                                <div class="col-3">

                                    <div class="float-end">
                                        <?php if ($item['status'] == 0) { ?>


                                        <?php } ?>
                                        <?php if ($item['status'] == 1) { ?>
                                            <label> <a href="del_address.php?id=<?php echo $item['id_address']; ?>" class="del_address float-end">ลบ </a></label>

                                        <?php } ?>

                                        &nbsp;&nbsp;

                                        <label type="button " class="float-end" data-bs-toggle="modal" data-bs-target="#ID<?php echo $item['id_address']; ?>">
                                            แก้ไข
                                        </label>
                                    </div>



                                    <br>
                                    <br>


                                    <Form action="address_status.php" method="POST">
                                        <div>
                                            <?php if ($item['status'] == 0) { ?>

                                                <button class="btn card float-end" disabled>ตั้งเป็นค่าตั้งต้น</button>
                                            <?php } ?>
                                            <?php if ($item['status'] == 1) { ?>
                                                <button class="btn card float-end">ตั้งเป็นค่าตั้งต้น</button>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="status_address" value="0">
                                        <input type="hidden" name="id_address" value="<?php echo $item['id_address'] ?>">
                                        <input type="hidden" name="user" value="<?php echo $_SESSION['id'] ?>">


                                    </Form>
                                </div>
                                <hr class="my-4">
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal แก้ไช -->

<?php foreach ($result as $row => $item2) { ?>

    <div class="modal fade" id="ID<?php echo $item2['id_address']; ?>" tabindex="-1" aria-labelledby="55" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="55"> แก้ไขที่อยู่จัดส่ง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="address_db.php" method="POST">

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control me-3" name="firstname2" value="<?php echo $item2['firstname']; ?>" placeholder="ชื่อ">

                            <input type="text" class="form-control" name="lastname2" value="<?php echo $item2['lastname']; ?>" placeholder="นามสกุล">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="phone2" value="<?php echo $item2['phone']; ?>" placeholder="หมายเลขโทรศัพท์">
                        </div>
                        <div class="input-group mb-3">

                            <Select class="form-select" name="province2" id="province2<?php echo $item2['id_address']; ?>">
                                <option value="<?php echo $item2['ProvinceID'] ?>" selected readonly><?php echo $item2['ProvinceThai']; ?></option>
                                <option value="" disabled>-----------------------</option>
                                <?php foreach ($query as $value) { ?>
                                    <option value="<?php echo $value['ProvinceID']; ?>">
                                        <?php echo $value['ProvinceThai']; ?> </option>
                                <?php } ?>
                            </Select>
                            <Select class="form-select" name="amphures2" id="amphures2<?php echo $item2['id_address']; ?>">
                                <option value="<?php echo $item2['DistrictID']; ?>" selected> <?php echo $item2['DistrictName']; ?> </option>
                            </Select>
                        </div>
                        <div class="input-group mb-3">
                            <Select class="form-select" name="districts2" id="districts2<?php echo $item2['id_address']; ?>">
                                <option value="<?php echo $item2['TambonID']; ?>" selected><?php echo $item2['TambonName']; ?></option>
                            </Select>
                            <input class="form-control" type="text" name="zipcode2" value="<?php echo $item2['zipcode']; ?>" id="zipcode2<?php echo $item2['id_address']; ?>" placeholder="รหัสไปรษณีย์">
                        </div>
                        <div class="input-group mb-3 ">
                            <textarea type="text" class="form-control text-align top-left " name="address_details2" id="" cols="10" rows="10" placeholder="รายละเอียดที่อยู่" style="height: 70px;">
                                  <?php echo $item2['address_details']; ?>        
                        </textarea>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-primary">ยืนยัน</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                    <input type="hidden" name="id_address_up" value="<?php echo $item2['id_address'] ?>">

                </form>

            </div>
        </div>

    </div>

    <script type="text/javascript">
        $('#province2<?php echo $item2['id_address']; ?>').change(function() {
            var id_province = $(this).val();
            $.ajax({
                type: "post",
                url: "ajax_address2.php",
                data: {
                    id: id_province,
                    function: 'provinces2'
                },
                success: function(data) {
                    $('#amphures2<?php echo $item2['id_address']; ?>').html(data);
                    $('#districts2<?php echo $item2['id_address']; ?>').html('');
                    $('#zipcode2<?php echo $item2['id_address']; ?>').val('');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#amphures2<?php echo $item2['id_address']; ?>').change(function() {
            var id_amphures = $(this).val();
            $.ajax({
                type: "post",
                url: "ajax_address2.php",
                data: {
                    id: id_amphures,
                    function: 'amphures2'
                },
                success: function(data) {
                    $('#districts2<?php echo $item2['id_address']; ?>').html(data);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#districts2<?php echo $item2['id_address']; ?>').change(function() {
            var id_districts = $(this).val();
            $.ajax({
                type: "post",
                url: "ajax_address2.php",
                data: {
                    id: id_districts,
                    function: 'districts2'
                },
                success: function(data) {
                    // console.log(data)
                    $('#zipcode2<?php echo $item2['id_address']; ?>').val(data)
                }
            });
        });
    </script>

<?php } ?>

<script>
    $('.del_address').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่ว่าต้องการลบที่อยู่นี้ ?',
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

<script type="text/javascript">
    $('#province').change(function() {
        var id_province = $(this).val();
        $.ajax({
            type: "post",
            url: "ajax_address.php",
            data: {
                id: id_province,
                function: 'provinces'
            },
            success: function(data) {
                $('#amphures').html(data);
                $('#districts').html('');
                $('#zipcode').val('');
            }
        });
    });
</script>
<script type="text/javascript">
    $('#amphures').change(function() {
        var id_amphures = $(this).val();
        $.ajax({
            type: "post",
            url: "ajax_address.php",
            data: {
                id: id_amphures,
                function: 'amphures'
            },
            success: function(data) {
                $('#districts').html(data);
            }
        });
    });
</script>
<script type="text/javascript">
    $('#districts').change(function() {
        var id_districts = $(this).val();
        $.ajax({
            type: "post",
            url: "ajax_address.php",
            data: {
                id: id_districts,
                function: 'districts'
            },
            success: function(data) {
                // console.log(data)
                $('#zipcode').val(data)
            }
        });
    });
</script>



<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<script>
    const button = document.querySelector(".btn-join");
    const modal = document.querySelector(".overlay");
    const close = document.querySelector(".btn-white");
    button.addEventListener("click", function() {
        modal.style.display = "block"
    })
    close.addEventListener("click", function() {
        modal.style.display = "none"
    })

    document.body.addEventListener("click", function(e) {
        if (e.target.classList[0] == "overlay") {
            modal.style.display = "none"
        }
    })
</script>
</div>
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
</div>
<?php require_once('include/footer.php'); ?>