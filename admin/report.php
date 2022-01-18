<!DOCTYPE html>
<html lang="en">
<?php require_once('connection/conn.php') ?>
<?php require_once('connection/connection.php') ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <title>Report</title>
    <?php require_once('include/linkcss.php')  ?>
    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
</head>


<body id="page-top">

    <?php require_once('include/header.php') ?>

    <?php require_once('include/headerpayment_status.php') ?>

    <script src="js/sb-admin-2.min.js"></script>

    <div class="container-fluid bg">

        <h1 class="app-page-title ">ออกรายงาน</h1>
        <hr class="mb-4">
        <p onclick="pdf()" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</p>
        <p id="productsell" class="btn btn-danger">ยอดขายสินค้า</p>
        <p id="typesell" class="btn btn-danger">ประเภท </p>

        <div class="row g-4 settings-section mt-3">

            <div class="col-12 col-md-12">
                <div class="col-3">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"> <i class="fas fa-table"></i></div>
                        </div>
                        <input type="text" name="daterange" value="" id="daterange" class="inputdate" />
                    </div>
                </div>

                <div class="app-card app-card-settings ">
                    <div class="app-card-body pageA4 text-black" id="pdf">

                        <div id="resultproduct"></div>
                        <div id="resulttype"></div>
                        <div id="result2"></div>

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
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src=" vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    </div>
    <script>
        function pdf() {
            var printpdf = $('#pdf').html();
            html2pdf().from(printpdf).save('report');
        }
    </script>
    <script>
        $(document).ready(function() {

            // <!-- เปลี่ยนวันที่-->

            $('#daterange').change(function() {
                var date = $('#daterange').val();
                // console.log(date);
                $.ajax({
                    url: 'productsell.php',
                    method: 'POST',
                    data: {
                        date: date,
                    },
                    success(data) {
                        $('#resultproduct').html(data);
                        $('#resulttype').hide();
                        $('#result2').hide();
                    }
                });
                $('#productsell').click(function() {

                    $.ajax({
                        url: 'productsell.php',
                        method: 'POST',
                        data: {
                            date: date,
                        },
                        success(data) {
                            $('#resultproduct').html(data).show();
                            $('#resulttype').hide();
                            $('#result2').hide();
                        }

                    });
                });
                // <!-- คลิปประเภท-->

                $('#typesell').click(function() {

                    $.ajax({
                        url: 'typesell.php',
                        method: 'POST',
                        data: {
                            date: date,
                        },
                        success(data) {
                            $('#resultproduct').hide();
                            $('#resulttype').html(data).show();
                            $('#result2').hide();
                        }

                    });
                });

            });
        });
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                    "locale": {
                        "format": "YYYY/MM/DD",
                        "separator": " ถึง ",
                        "applyLabel": "ยืนยัน",
                        "cancelLabel": "ยกเลือก",
                        "fromLabel": "From",
                        "toLabel": "To",
                        "customRangeLabel": "เลือกวันที่",
                        "daysOfWeek": [
                            "อา",
                            "จ",
                            "อ",
                            "พ",
                            "พฤ",
                            "ศ",
                            "ส"
                        ],
                        "monthNames": [
                            "มกราคม ",
                            "กุมภาพันธ์ ",
                            "มีนาคม ",
                            "เมษายน ",
                            "พฤษภาคม ",
                            "มิถุนายน ",
                            "กรกฎาคม ",
                            "สิงหาคม ",
                            "กันยายน ",
                            "ตุลาคม ",
                            "พฤศจิกายน ",
                            "ธันวาคม "
                        ],
                        "firstDay": 1
                    },
                    "singleDatePicker": false,
                    ranges: {
                        'วันนี้': [moment(), moment()],
                        'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '7 วันล่าสุด': [moment().subtract(6, 'days'), moment()],
                        '30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
                        'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                        'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'ปีนี้': [moment().startOf('year'), moment().endOf('days')],

                    },

                },
                function(start, end, label) {
                    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
                });
        });
    </script>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <?php require_once('include/footer.php') ?>
    <!-- <script>
        function allsell() {
            load_data();
            var Payment = $('#Payment').val();

            function load_data(query) {
                $.ajax({
                    url: "productsell.php",
                    method: "post",
                    data: {
                        query: query,
                        $pay: Payment,

                    },
                    success: function(data) {
                        $('#filter_data').html(data);


                    }
                });
            }
        }
    </script> -->
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