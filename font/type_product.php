<?php require_once('connection/conn.php'); ?>
<?php require_once('connection/connection.php'); ?>
<!DOCTYPE html>
<!-- <?php
        // $sql1 = "SELECT * FROM tb_color";
        // $sql = "SELECT * FROM tb_type_product";
        // $sql2 = "SELECT * FROM tb_size";
        // $result_type_product = mysqli_query($connection, $sql);
        // $result_color = mysqli_query($connection, $sql1);
        // $result_size = mysqli_query($connection, $sql2);
        // $sql = "SELECT * FROM tb_product";
        // if (isset($_GET['type_product_id']) && !empty($_GET['type_product_id'])) {
        //     $sql .= " WHERE type_product_id ='" . $_GET['type_product_id'] . "'";
        // }
        // if (isset($_GET['tb_color_id']) && !empty($_GET['tb_color_id'])) {
        //     $sql .= " WHERE tb_color_id ='" . $_GET['tb_color_id'] . "'";
        // }
        // if (isset($_GET['tb_size_id']) && !empty($_GET['tb_size_id'])) {
        //     $sql .= " WHERE tb_size_id ='" . $_GET['tb_size_id'] . "'";
        // }
        // $result_product = mysqli_query($connection, $sql);
        ?> -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../font/assets/style.css">
    <link rel="stylesheet" href="../font/assets/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!--  -->
    <script src="assets/jquery-ui.js"></script>
    <link href="assets/jquery-ui.css" rel="stylesheet">
    <!-- Custom CSS -->

    <title>รายการสินค้า</title>
</head>


<body>
    <div class="top-btn">
        <i class="fas fa-arrow-up"></i>
    </div>

    <?php require_once('include/header.php'); ?>
    <div class="bg-22"></div>
    <div class="container">
        <div class="row">

            <h2 class="text-center my-5">รายการสินค้า</h2>
            <br>
            <div class="col-md-3">

                <div class="list-group">
                    <hr class="mb-2 mt-4">

                    <div class="">
                        <div class="input-group">
                            <input type="text" value="" class="form-control" name="search_text" id="search_text" placeholder="ค้นหาสินค้า...">
                            <div class="input-group-prepend">
                                <div class="text-center">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <input type="text" value="" class="form-control" name="search_text" id="search_text" placeholder="ค้นหาสินค้า..."> -->
                    <br>
                    <p class="text-type">ราคา</p>
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="2000" />
                    <p id="price_show">50 - 2000</p>
                    <div id="price_range"></div>
                </div>
                <?php
                $query = "SELECT DISTINCT title_type FROM tb_product as p
                       JOIN tb_type_product as t ON p.type_product_id =t.id_type_product
                       JOIN tb_size as s ON p.tb_size_id =s.id_size
                       JOIN tb_color as c ON p.tb_color_id = c.id_color WHERE p.status = '0' AND t.status = '0'";
                $statement = $conn->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                ?>
                <div class="item mt-3">
                    <a class="sub-btn nav-link link-dark text-type mt-3">หมวดหมู่<i class="fas fa-angle-right dropdown float-end"></i></a>
                    <div class="sub-menu">
                        <?php foreach ($result as $row) { ?>
                            <div class="container1">
                                <label><input type="checkbox" class="common_selector title_type" value="<?php echo $row['title_type']; ?>"> <?php echo $row['title_type']; ?>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!--  -->
                <?php
                $query = "SELECT DISTINCT title_color FROM tb_product as p
                       JOIN tb_type_product as t ON p.type_product_id =t.id_type_product
                       JOIN tb_size as s ON p.tb_size_id =s.id_size
                       JOIN tb_color as c ON p.tb_color_id = c.id_color WHERE p.status = '0' AND t.status = '0'";
                $statement = $conn->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                ?>
                <div class="item mt-3">
                    <a class="sub-btn nav-link link-dark text-type">สี<i class="fas fa-angle-right dropdown float-end"></i></a>
                    <div class="sub-menu">
                        <?php foreach ($result as $row) { ?>
                            <div class="container1">
                                <label><input type="checkbox" class="common_selector title_color" value="<?php echo $row['title_color']; ?>"> <?php echo $row['title_color'];  ?>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        <?php } ?>


                    </div>
                </div>
                <!--  -->
                <?php
                $query = "SELECT DISTINCT title_size FROM tb_product as p
                       JOIN tb_type_product as t ON p.type_product_id =t.id_type_product
                       JOIN tb_size as s ON p.tb_size_id =s.id_size
                       JOIN tb_color as c ON p.tb_color_id = c.id_color WHERE p.status = '0'AND t.status = '0' ";
                $statement = $conn->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                ?>
                <div class="item mt-3">
                    <a class="sub-btn nav-link link-dark text-type">ไซส์<i class="fas fa-angle-right dropdown float-end"></i></a>
                    <div class="sub-menu">
                        <?php foreach ($result as $row) { ?>
                            <div class="container1">
                                <label><input type="checkbox" class="common_selector title_size" value="<?php echo $row['title_size']; ?>"> <?php echo $row['title_size']; ?>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        <?php } ?>
                    </div>
                </div>
                <!--  -->
            </div>
            <!--  -->
            <div class="col-md-9">
                <br />
                <div class="row filter_data" id="filter_data">
                </div>
            </div>
        </div>

    </div>
    <?php
    if (@$_SESSION['m'] == 1) {
        echo "<script>
        Swal.fire({
            position: '',
            icon: 'success',
            title: 'เพิ่มเข้าไปในกระเป๋าสำเร็จแล้ว',
            showConfirmButton: false,
            timer: 1500
          })
        </script>   ";

        unset($_SESSION['m']);
    }
    ?>


    <style>
        #loading {
            text-align: center;
            background: url('loader.gif') no-rep eat center;
            height: 150px;
        }
    </style>

    <script>
        $(document).ready(function() {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "fetch_data2.php",
                    method: "post",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#filter_data').html(data);
                    }
                });
            }

            $('#search_text').keyup(function() {
                var search = $('#search_text').val();

                if (search != '') {
                    load_data(search);
                } else {
                    load_data();
                }

            });
        });
    </script>

    <script>
        $(document).ready(function() {

            filter_data();


            function filter_data(query) {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var title_type = get_filter('title_type');
                var title_color = get_filter('title_color');
                var title_size = get_filter('title_size');
                var search = $('#search_text').val();

                $.ajax({
                    url: "fetch_data.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        title_type: title_type,
                        title_color: title_color,
                        title_size: title_size,
                        search: search,
                        query: query
                    },
                    success: function(data) {
                        $('#filter_data').html(data);

                    }
                });
                $('#search_text').val('');

            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').click(function() {
                filter_data();
            });
            // $('#search_text').keyup(function() {
            //     var search = $('#search_text').val();
            //     if (search != '') {
            //         filter_data(search);
            //     } else {
            //         filter_data();
            //     }
            // });
            $('#price_range').slider({
                range: true,
                min: 50,
                max: 2000,
                values: [50, 2000],
                step: 50,
                stop: function(event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });

        });
    </script>



    <script type="text/javascript">
        $(document).ready(function() {
            //jquery for toggle sub menus


            $('.sub-btn').click(function() {

                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
            });

            //jquery for expand and collapse the sidebar
            $('.menu-btn').click(function() {
                $('.side-bar').addClass('active');
                $('.menu-btn').css("visibility", "hidden");
            });

            $('.close-btn').click(function() {
                $('.side-bar').removeClass('active');
                $('.menu-btn').css("visibility", "visible");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once('include/footer.php'); ?>
</body>

</html>