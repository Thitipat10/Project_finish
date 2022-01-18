<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin</title>
	<?php require_once('include/linkcss.php') ?>
	<?php require_once('connection/connection.php') ?>

</head>

<body id="page-top">

	<?php require_once('include/header.php') ?>


	<div class="container-fluid container card p-3">
		<h1 class="app-page-title ">ข้อมูลผู้ดูแลระบบ <a href="admin.php"> <button type="button" class="btn btn-primary mb-4 float-right">ย้อนกลับ</button></a></h1>
		<div class="app-card-body ">
			<?php
			if (isset($_POST) && !empty($_POST)) {

				$user = $_POST['user'];
				$pass = md5($_POST['pass']);
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$role = 'a';
				if (!empty($user)) {
					$sql_check = "SELECT * FROM tb_admin WHERE user = '$user'";
					$query_check = mysqli_query($connection, $sql_check);
					$row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
					if ($row_check > 0) {
						echo "<script>
						Swal.fire({s
							position: '',
							icon: 'error',
							title: 'ชื่อผู้ใช้ซ้ำ กรุณากรอกใหม่',
							showConfirmButton: false,
							timer: 1500
						  })

						</script>    ";
					} else {
						if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
							$extension = array("jpeg", "jpg", "png");
							//ประเภทไฟล์
							$target = 'upload/admin/';
							//ไฟล์ที่จะเก็บรูปภาพ
							$filename = $_FILES['image']['name'];
							$filetmp = $_FILES['image']['tmp_name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							// เรียกไฟล์เฉพาะ.
							//echo $ext;
							if (in_array($ext, $extension)) {
								if (!file_exists($target . $filename)) {  // ไม่มีชื่อไฟล์ซ้ำ
									if (move_uploaded_file($filetmp, $target . $filename)) {
										$filename = $filename;
									} else {
										echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
									}
								} else {
									$newfilename = time() . $filename;
									if (move_uploaded_file($filetmp, $target . $newfilename)) {
										$filename = $newfilename;
									} else {
										echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
									}
								}
							} else {
								echo "ประเภทไฟล์ไม่ถูกต้อง";
							}
						} else {
							$filename = '';
						}
						//echo $filename;
						//exit(); 
						if (!empty($user)) {
							$sql_check = "SELECT * FROM tb_admin WHERE user = '$user'";
							$query_check = mysqli_query($connection, $sql_check);
							$row_check = mysqli_num_rows($query_check); //ถ้ามีค่า user ส่งเข้ามาซ้ำกันใน db ถ้ามีเท่า 1
							if ($row_check > 0) {
								echo 'ชื่อผู้ใช้ซ้ำ กรุณากรอกใหม่อีกครั้ง';
							}
						}
						$sql = "INSERT INTO tb_admin 
												   (firstname, lastname, email, phone, user, pass,image,role)
											VALUES ('$firstname', '$lastname', '$email','$phone','$user','$pass','$filename','$role')";

						if (mysqli_query($connection, $sql)) {
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($connection);
						}

						mysqli_close($connection);
					}
				}
			}
			?>
			<img id="output" width="150px" height="150px" src="https://i1.sndcdn.com/artworks-000335143458-q3i6f4-t500x500.jpg" />
			<form action="" method="POST" enctype="multipart/form-data" id="form_con">
				<div class="mb-3">
					<label class="form-label">เลือกรูปภาพ </label>
					<span id="alert_image" class="text-danger"></span>
					<input type="file" accept="image/*" onchange="loadFile(event)" name="image" id="image" class="mt-4">


				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อผู้ใช้ </label>
					<input type="text" class="form-control" name="user" id="user" placeholder="ชื่อผู้ใช้ : admin" required>
					<span id="alert_user" class="text-danger"></span>
				</div>
				<div class="mb-3">
					<label class="form-label">รหัสผ่าน</label>
					<input type="text" class="form-control" name="pass" id="pass" placeholder="รหัสผ่าน : 123456" required>
					<span id="alert_pass" class="text-danger"></span>

				</div>
				<hr class="mb-3 mt-4">
				<div class="mb-3">
					<label class="form-label">ชื่อ</label>
					<input type="text" class="form-control" name="firstname" id="firstname" placeholder="ขื่อ" required>
					<span id="alert_firstname" class="text-danger"></span>
				</div>
				<div class="mb-3">
					<label class="form-label">นามสกุล</label>
					<input type="text" class="form-control" name="lastname" id="lastname" placeholder="นามสกุล" required>
					<span id="alert_lastname" class="text-danger"></span>
				</div>
				<div class="mb-3">
					<label class="form-label">อีเมล์</label>
					<input type="email" class="form-control" name="email" id="email" placeholder="อีเมล์" required>
					<span id="alert_email" class="text-danger"></span>
				</div>
				<div class="mb-3">
					<label class="form-label">เบอร์ติดต่อ</label>
					<input type="text" class="form-control" name="phone" id="phone" placeholder="เบอร์ติดต่อ" required>
					<span id="alert_phone" class="text-danger"></span>
				</div>
				<button type="button" class="btn btn-primary" onclick="insertadmin()">บันทึก</button>
			</form>

		</div>
		<!--//app-card-body-->


		<!-- <script>
			$(":file").on("change", function(e) {
				var file = this.files[0];
				var fileType = file["type"];
				console.log(fileType);
				var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
				if ($.inArray(fileType, validImageTypes) < 0) {
					alert(1);
				}
			});
		</script> -->

		<script>
			function insertadmin() {

				var image = $('#image').val();
				var user = $('#user').val();
				var pass = $('#pass').val();
				var firstname = $('#firstname').val();
				var lastname = $('#lastname').val();
				var email = $('#email').val();
				var phone = $('#phone').val();


				if (image == '') {
					$('#alert_image').html('กรุณาใส่รูป');

				} else {
					$('#alert_image').html('');
				}
				if (user == '') {
					$('#alert_user').html('กรุณากรอกชื่อผู้ใช้');
				} else {
					$('#alert_user').html('');
				}
				if (pass == '') {
					$('#alert_pass').html('กรุณากรอกรหัสผ่าน');

				} else {
					$('#alert_pass').html('');
				}
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
				if (email == '') {
					$('#alert_email').html('กรุณากรอกอีเมล');

				} else {
					$('#alert_email').html('');
				}
				if (phone == '') {
					$('#alert_phone').html('กรุณากรอกเบอร์โทรศัพท์');

				} else {
					$('#alert_phone').html('');
				}

				if (image != '' & user != '' & pass != '' & firstname != '' & lastname != '' & email != '' & phone != '') {
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


</div>
<!--//container-fluid-->
</div>
<!--//app-content-->


</div>
<!--//app-wrapper-->



</div>

<?php require_once('include/footer.php') ?>
<?php require_once('include/script.php') ?>


<!-- เช็คไฟล์รูป  -->
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
			$('#output').attr('src', 'https://i1.sndcdn.com/artworks-000335143458-q3i6f4-t500x500.jpg');


		} else {
			output.src = URL.createObjectURL(event.target.files[0]);
			output.onload = function() {
				URL.revokeObjectURL(output.src) // free memory
			}
		}
	});
</script>
<!-- <script>
	var loadFile = function(event) {

	};
</script> -->

</body>

</html>