<!DOCTYPE html>
<html lang="en">

<?php require_once('include/script.php') ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <title>Admin</title>
    <?php require_once('include/linkcss.php') ?>
    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
</head>
<?php
if (isset($_POST) && !empty($_POST)) {
    // print_r($_POST['description']);
    // echo
    // $_POST['id'];

    $description = $_POST['description'];
    $id = $_POST['id'];
    $sql = "UPDATE tb_about SET description='$description' WHERE id=$id";
    $query = mysqli_query($connection, $sql);
}


?>

<?php $sql2 = "SELECT * FROM tb_about";
$query2 = mysqli_query($connection, $sql2);
$result2 = mysqli_fetch_assoc($query2);

?>


<body id="page-top">

    <?php require_once('include/header.php') ?>
    <script src="js/sb-admin-2.min.js"></script>


    <div class="container-fluid ">
        <h1 class="app-page-title ">จัดการข้อมูลเกียวกับฉัน</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-12">
                <div class="app-card app-card-settings card p-4">
                    <div class="app-card-body">
                        <form action="" method="POST" id="form_con">

                            <textarea name="description" id="description" rows="10" cols="80">
                          <?php echo $result2['description']; ?>
           
                     </textarea>
                            <input type="hidden" name="id" value="<?php echo $result2['id']; ?>">
                            <br>
                            <button type="button" class="btn btn-primary" onclick="about()">บันทึก</button>
                        </form>
                    </div>

                    <!--//app-card-body-->

                </div>
                <!--//app-card-->
            </div>
        </div>
        <!--//row-->
        <script src="ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('description', {
                height: '500px',
                filebrowserUploadMethod: 'form',
                filebrowserUploadUrl: 'upload.php'
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#table_id').DataTable();
            });
        </script>

        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <script>
        function about() {

            Swal.fire({
                title: 'ยืนยันกาเปลี่ยนข้อมูล',

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
</body>

</html>