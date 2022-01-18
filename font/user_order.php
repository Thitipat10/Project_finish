<title>รายการคำสั่งซื้อ</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php require_once('account.php'); ?>
<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<?php



?>



<div class="col-10 ">
    <div class="row">

        <div class="col-12 col-lg-12 my-2">
            <h3 class="app-page-title mb-4 ">รายการคำสั่งซื้อ</h3>

            <div class="btnuser shadow-sm my-2">
                <button onclick="ALL()" value="ALL" id="ALL" class="ALL">ทั้งหมด</button>
                <button onclick="Payment()" value="Payment" id="Payment" class="pay">ที่ต้องชำระ</button>
                <button onclick=" delivery()" value="delivery" id="delivery" class="delivery">ที่ต้องจัดส่ง</button>
                <button onclick="received()" value="received" id="received" class="received">ที่ต้องได้รับ</button>
                <button onclick="done()" value="done" id="done" class="done">สำเร็จแล้ว</button>
                <button onclick="cancelmenu()" value="cancelmenu" id="cancelmenu" class="cancelmenu">ยกเลิกแล้ว</button>
            </div>


            <div id="filter_data"></div>
        </div>

    </div>

</div>

</div>

</div>
<script>
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "waiting_payment.php",
                method: "post",
                data: {
                    query: query,
                },
                success: function(data) {
                    $('#filter_data').html(data);

                }
            });
        }
    });
</script>

<script>
    function Payment() {
        load_data();
        var Payment = $('#Payment').val();

        function load_data(query) {
            $.ajax({
                url: "waiting_payment.php",
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
</script>
<script>
    function ALL() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "all_user_order.php",
                method: "post",
                data: {
                    query: query,

                },
                success: function(data) {
                    $('#filter_data').html(data);

                }
            });
        }
    }
</script>

<script>
    function delivery() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "delivery_user.php",
                method: "post",
                data: {
                    query: query,

                },
                success: function(data) {
                    $('#filter_data').html(data);

                }
            });
        }
    }
</script>
<script>
    function received() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "received_user.php",
                method: "post",
                data: {
                    query: query,

                },
                success: function(data) {
                    $('#filter_data').html(data);

                }
            });
        }
    }
</script>
<script>
    function done() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "done.php",
                method: "post",
                data: {
                    query: query,

                },
                success: function(data) {
                    $('#filter_data').html(data);

                }
            });
        }
    }
</script>
<script>
    function cancelmenu() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "cancel_user.php",
                method: "post",
                data: {
                    query: query,

                },
                success: function(data) {
                    $('#filter_data').html(data);

                }
            });
        }
    }
</script>



<?php require_once('include/footer.php'); ?>