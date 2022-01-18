    <?php require_once('include/linkcss.php') ?>
    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {


        $id = $_GET['id'];

        $sql = "SELECT * FROM tb_orders  WHERE  OrderID = $id";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_assoc($query);
    }


    ?>

    <style>
        @media print {

            @page {
                size: A6;
                size: landscape;
            }

            .ddd {
                width: 180mm;

            }

            .mar {
                font-size: 18px;
            

            }

            body {
                background-color: #000;
            }


        }
    </style>

    <body>
        <div class="mb-5">

        </div>
        <div class="mx-4">

        </div>
        <div class="row ddd mar">
            <div class="col-5">
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
                โทรศัพท์:097-276-5750
                <br>
                Email:Siraon_shop@gmail.com
            </div>
            <div class="col-1">

            </div>
            <div class="col-5">
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
                    Email: <?php echo $result2['email'] ?>


                <?php } ?>

            </div>
        </div>

        <script type="text/javascript">
            window.addEventListener("Load", window.print());
        </script>
    </body>

    </html>